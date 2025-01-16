
import { LoginSection} from "./components/sections/LoginSection"

export default function Home() {

  return (
      <main className="w-screen h-screen flex flex-col sm:flex-row">
        <div className="w-full sm:w-[75%] flex items-center">
          <div className="w-full bg-cover no-repeat h-screen flex items-center justify-end bg-[url('/estudiante.webp')]">
            <p className="text-[12px] sm:text-[35px] text-center text-white w-[40%] mr-[5%]">Encuentra el sitio, momento y profesor perfecto para ti</p>
          </div>
        </div>
        <LoginSection/>
      </main>
  );
}
