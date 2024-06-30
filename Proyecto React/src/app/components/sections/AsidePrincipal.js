import Image from "next/image";
import { Contacto } from "../buttons/Contacto";
import { ClasesReservadas } from "../buttons/ClasesReservadas";
import { MisAnuncios } from "../buttons/MisAnuncios";
import { LogOut } from "../buttons/LogOut";


export function AsidePrincipal(){
    return(
        <aside className="w-full sm:w-[25%] h-full bg-[#061a2d] flex flex-col items-center pb-[50px] sm:pb-0">
            <Image src={"/fotoperfil.webp"} width={150} height={50} alt="foto de perfil" className="mt-[30px]" />
            <p className="text-white">Nombre de  Usuario</p>
            <p className="text-white">correo@correo.com</p>
            <form className="my-auto gap-y-[20px] flex flex-col w-full">
                <div className="flex flex-col text-white items-center">
                    <label className="text-[15px] mb-[10px]">Elige el nivel</label>
                    <select id="nivel" className="bg-black w-[50%] h-[40px] flex items-center justify-center rounded-[5px] border-white border-[1px]">
                        <optgroup label="ESO">
                            <option>1r curso</option>
                            <option>2d curso</option>
                            <option>3r curso</option>
                            <option>4o curso</option>
                        </optgroup>
                        <optgroup label="Ciclo Formativo">
                            <option>Grado Superior</option>
                            <option>Grado Medio</option>
                        </optgroup>
                        <optgroup label="Universidad">
                            <option>Ingenieria</option>
                            <option>Fisica</option>
                        </optgroup>
                    </select>
                </div>
                <div className="flex flex-col text-white items-center w-full">
                    <label className="text-[15px] mb-[10px]">Elige el Materia</label>
                    <select id="nivel" className="bg-black w-[50%] h-[40px] flex items-center justify-center rounded-[5px] border-white border-[1px]">
                        <optgroup label="Ciencias">
                            <option>Fisica</option>
                            <option>Matemáticas</option>
                            <option>Química</option>
                            <option>Tecnología</option>
                        </optgroup>
                        <optgroup label="Ciclo Formativo">
                            <option>Grado Superior</option>
                            <option>Grado Medio</option>
                        </optgroup>
                        <optgroup label="Universidad">
                            <option>Ingenieria</option>
                            <option>Fisica</option>
                        </optgroup>
                    </select>
                </div>
            </form>
            <div className="flex flex-col gap-y-[20px] w-full items-center my-auto">
                <Contacto/>
                <ClasesReservadas/>
                <MisAnuncios/>
                <LogOut/>
            </div>
        </aside>
    )
}