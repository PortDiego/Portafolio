import Image from "next/image";

export function Header(){
    return(
        <header className="flex w-screen sm:absolute">
            <Image src="/logotipo.webp" width={350} height={50} alt="logotipo" className="sm:mt-[50px] mx-auto sm:ml-[5%]"/>
        </header>
    )
}