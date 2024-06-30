import {AsidePrincipal} from "../components/sections/AsidePrincipal"
import { TableroAnuncios } from "../components/sections/TableroAnuncios"

export default function Principal(){
    return(
        <main className="w-screen h-screen flex flex-col sm:flex-row">
            <div className="w-full sm:w-[75%] my-[30px] sm:mt-[160px] flex ">
                <TableroAnuncios/>
            </div>
            <AsidePrincipal/>
        </main>
    )
}