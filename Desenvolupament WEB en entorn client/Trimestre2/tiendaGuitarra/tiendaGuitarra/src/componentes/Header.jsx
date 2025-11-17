import { Fragment } from "react";

export default function Header(){

    const nombre = "Carlos";

    return(
        <React.Fragment>
            <h2>Hola: {nombre}</h2>
            <p>Usando Fragment: Ejemplo 1</p>
        </React.Fragment>
    )
}