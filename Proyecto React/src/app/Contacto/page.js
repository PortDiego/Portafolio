import { AsideGeneral } from "../components/sections/AsideGeneral"

export default function Contacto(){
    return(
        <main className="w-screen h-screen flex flex-col sm:flex-row">
            <div className="w-full sm:w-[75%]">
                <section className="w-[85%] mt-[50px] mx-auto flex flex-col">
                    <div className="w-full mx-auto sm:mt-[108px] flex flex-col sm:flex-row mb-[165px]">
                        <div className="w-[51%]">
                            <p>Contáctanos</p>
                            <p className="text-[15px] mt-[11px]"> <span className="icon-phone text-[14px] mr-[14px]"/>93 100 6211</p>
                            <p className="text-[15px] mt-[13px]"> <span className="icon-mail text-[14px] mr-[14px]"/>info@cutomclass.com</p>

                            <p className="mt-[53px]">Síguenos</p>
                            <p className="text-[15px] mt-[13px]"> <span className="icon-instagram text-[14px] mr-[14px]"/>Instagram</p>
                            <p className="text-[15px] mt-[16px]"> <span className="icon-fb text-[14px] mr-[14px]"/>Facebook</p>
                            <p className="text-[15px] mt-[16px]"> <span className="icon-youtube text-[14px] mr-[14px]"/>Youtube</p>
                            <p className="text-[15px] mt-[16px]"> <span className="icon-tiktok text-[14px] mr-[14px]"/>TikTok</p>
        
                        </div>
                        <form className="w-[90%] sm:w-[41%] mt-[30px] sm:mt-0 uppercase flex flex-col">
                            <label className="text-[10px]">nombre<sup>*</sup></label>
                            <input type="text" name="nombre" className="border-b border-black mt-[20px]"/>
                            <label className="mt-[40px] text-[10px]">email<sup>*</sup></label>
                            <input type="email" name="email" className="border-b border-black mt-[20px]"/>
                            <label className="mt-[40px] text-[10px]">telefono<sup>*</sup></label>
                            <input type="fel" name="telf" className="border-b border-black mt-[20px]"/>
                            <label className="mt-[40px] text-[10px]">mensaje</label>
                            <input type="text" name="mensaje" className="border-b border-black mt-[20px] mb-[30px]"/>
                        </form>
                    </div>
                </section>
            </div>
            <AsideGeneral/>
        </main>
    )
}