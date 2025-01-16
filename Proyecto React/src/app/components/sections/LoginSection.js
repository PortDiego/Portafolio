import { GoogleLogin } from "../buttons/GoogleLogin"
import { AppleLogin } from "../buttons/AppleLogin"
import { FacebookLogin } from "../buttons/FacebookLogin"
import { EmailLogin } from "../buttons/EmailLogin"
import { Contacto } from "../buttons/Contacto"

export function LoginSection(){
    return(
        <aside className="w-full sm:w-[25%] bg-[#061a2d] flex items-center flex-col gap-y-[80px] pb-[50px] sm:pb-0">
            <span className="icon-login text-[100px] pt-[70px] text-[50px] text-center text-white"> 
                <p className=" text-white text-[40px] pt-[30px]">Iniciar Sesión</p>
            </span>

            <div className="w-full flex flex-col items-center gap-[35px]">
                <GoogleLogin/>
                <AppleLogin/>
                <FacebookLogin/>
            </div>
            <div className="w-full flex items-center flex-col gap-[20px]">
                <p className="text-white">Accede mediante link</p>
                <EmailLogin/>
                <Contacto/>
            </div>
        </aside>
    )
}