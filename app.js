// Importamos las librerías necesarias
const express = require('express');
const mysql = require('mysql');

// Creamos una instancia de Express
const app = express();

// Configuramos la conexión a la base de datos
let conexion = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "smartdrink"
})

// Configuramos el motor de vistas como EJS
app.set("view engine", "ejs");

// Configuramos Express para manejar datos JSON y formularios
app.use(express.json());
app.use(express.urlencoded({ extended: false }));

// Ruta para la página principal
app.get("/", function (req, res) {
    res.render("index");
});

// Ruta para servir archivos estáticos
app.use(express.static("public"));

// Función para registrar un usuario en la base de datos
app.post("/Registrar", async function (req, res) {
    try {
        const { txtNombre, txtEmail, txtPassword } = req.body;

        // Consulta para verificar si el usuario ya existe
        const buscarQuery = "SELECT * FROM usuario WHERE nombre_usuario = ?";
        const buscarResult = await queryPromise(buscarQuery, [txtNombre]);

        if (buscarResult.length > 0) {
            console.log("El usuario ya existe");
            res.status(409).send("El usuario ya existe");
        } else {
            // Consulta para insertar un nuevo usuario
            const registrarQuery = "INSERT INTO usuario (nombre_usuario, correo, contrasenia) VALUES (?, ?, ?)";
            await queryPromise(registrarQuery, [txtNombre, txtEmail, txtPassword]);

            console.log("Datos almacenados correctamente");
            res.status(200).send("Datos almacenados correctamente");
        }
    } catch (error) {
        console.error("Error:", error.message);
        res.status(500).send("Ha ocurrido un error");
    }
});

// Función para ejecutar consultas SQL con promesas
function queryPromise(query, values) {
    return new Promise((resolve, reject) => {
        // Realizamos la consulta a la base de datos
        conexion.query(query, values, function (error, rows) {
            if (error) {
                reject(error);  // Se rechaza la promesa si hay un error
            } else {
                resolve(rows);  // Se resuelve la promesa con los resultados
            }
        });
    });
}

// Configuramos el puerto para el servidor local
app.listen(3000, function () {
    console.log("El servidor está escuchando en http://localhost:3000");
})
