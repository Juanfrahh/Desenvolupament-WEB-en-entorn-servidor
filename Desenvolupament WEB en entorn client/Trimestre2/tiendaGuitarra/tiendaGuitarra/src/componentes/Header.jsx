import { Fragment } from "react";

export default function Header(){

    const nombre = "Carlos";

    return(
        <Fragment>
            <h2>Hola: {nombre}</h2>
            <p>Usando Fragment: Ejemplo 1</p>
        </Fragment>
    )
}