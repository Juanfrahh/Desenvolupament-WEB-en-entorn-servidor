import { Fragment } from "react";

export default function Header(){

    const nombre = "Carlos";

    return(
        <Fragment>
            <h2>Hola: {nombre}</h2>
            <p>Hola otra vez</p>
        </Fragment>
    )
}