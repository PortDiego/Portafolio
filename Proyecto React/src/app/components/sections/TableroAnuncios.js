import { AnuncioItem } from "../items/AnuncioItem"

const anuncios = [
    {
        title: "Clases de matematicas - Nivel 3r ESO",
        description: "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit maiores aperiam earum unde sequi, debitis odit eos officiis dolore quos consequatur accusantium.",
        category: "Matematicas",
        price: 20,
        level: "ESO"
    },
    {
        title: "Clases de matematicas - Nivel 3r ESO",
        description: "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit maiores aperiam earum unde sequi, debitis odit eos officiis dolore quos consequatur accusantium.",
        category: "Matematicas",
        price: 20,
        level: "ESO"
    },
    
]

export function TableroAnuncios(){
    
    return(
        <div className="w-[90%] min-h-[90%] bg-[#9b9b9b] my-auto mx-auto rounded-[20px] border-[5px] border-[black] flex flex-col items-center">
            {anuncios.map((anuncio, key)=>(
                <AnuncioItem anuncio={anuncio} key={key}/>
            ))}
        </div>
    )
}