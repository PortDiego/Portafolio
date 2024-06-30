export function AnuncioItem(anuncio){
    
    return(
        <div className="w-[90%] min-h-[100px] my-[20px] flex flex-col bg-[#2271b3] rounded-[10px] border-[1px] border-black">
            <b className="ml-[5%] mt-[10px]">Titulo</b>
            <p className="ml-[5%]">Una descripcion donde el autor ha podido dar una breve explicacion de lo que puede aportar al alumno, el objetivo es llamar la atencion al posible estudiante para que al hacer click le envie a la pagina del anuncio y poderlo ver al detalle y reservar hora </p>
            <div className="flex flex-col sm:flex-row ml-[5%] pb-[10px] gap-[30px] mt-[20px]">
                <p><b>Categoria:</b> categoria</p>
                <p><b>Precio:</b>precio€</p>
                <p><b>Nivel:</b>Nivel</p>
            </div>
        </div>
    )
}