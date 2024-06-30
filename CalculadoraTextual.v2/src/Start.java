import java.util.Scanner;

public class Start {

	//Función Suma  
	public static float suma(float num1 , float num2)
	{
		float resultado= 0.0f;
		resultado= num1 + num2;
		return resultado; 
	}
	
	//Función Restar
	public static float resta(float num1, float num2)
	{
		float resultado= 0.0f;
		resultado= num1 - num2;
		return resultado;
	}
	
	//Función Multiplicación
	public static float multiplicacion(float num1, float num2)
	{
		float resultado= 0.0f;
		resultado= num1 * num2;
		return resultado;
	}
	
	//Función División
	public static float division(float num1, float num2)
	{
		if(num2!=0) 
		{
			float resultado= 0.0f;
			resultado= num1 / num2;
			return resultado;
		}
		else 
		{
			return -1.0f;
		}
	}
	
	//Función Número mayor de 3 números
	public static float mayor(float num1, float num2, float num3)
	{
		if((num1 > num2) && (num1 > num3))
		{
			return num1;
		}
		else if (num2 > num3) 
		{
			return num2;
		}
		else
		{
			return num3;
		}
	}

	//Función Factorial
	public static int factorial(int num)
	{
		int factor= 1;
		if (num<1)
		{
			return -1;
		}
		for (int i = num; i>=1; i--)
		{
			factor= factor* i;
		}
		return factor;
	}
	
	//Otra forma de sacar el factorial de un número con recursividad
	/*public static int factorial (int num)
	{
		if (num<1)
		{
			return -1;
		}
		else if (num==1)
		{
			return 1;
		}
		return num * factorial(num-1);
		
	}*/
	
	public static void main(String[] args) {
		// TODO Auto-generated method stub
		Scanner entradaDeDatos= new Scanner(System.in);
		
		
		//Cabecera del programa
		System.out.println("*************************************");
		System.out.println("*** CALCULADORA DE CALCULATOR S.A ***");
		System.out.println("*************************************");
		System.out.println("");
		System.out.println("");

		//Variables
		String opcion=("");
		float num1= 0.0f; 
		float num2= 0.0f;
		float num3= 0.0f;
		float resultado= 0.0f;
		
		//Bucle doWhile
		do {
			//Menú del programa
			System.out.println("Introduzca una opción del menú:" );
			System.out.println("1.- Función Sumar");
			System.out.println("2.- Función Restar");
			System.out.println("3.- Función Multiplicar");
			System.out.println("4.- Función Dividir");
			System.out.println("5.- Función Número mayor de 3 números");
			System.out.println("6.- Función Factorial");
			System.out.println("0.- Salir");
			System.out.print("Introduzca una opción: ");
			opcion = entradaDeDatos.next();
			
			//Condicional switch
			switch(opcion)
			{
				
				case "1":
						//Sumar
						System.out.println("");
						System.out.print("Introduzca el primer número flotante a sumar: " );
						num1 = entradaDeDatos.nextFloat();
						System.out.print("Introduzca el segundo número flotante a sumar: " );
						num2 = entradaDeDatos.nextFloat();
						resultado= suma(num1, num2);
						System.out.println("");
						System.out.println("************************************");
						System.out.println("La suma de " + num1 + " y " + num2 + " es " + resultado);
						System.out.println("************************************");
						System.out.println("");
						break;
						
						//Restar
				case "2":
						System.out.println("");
						System.out.print("Introduzca el primer número flotante a restar: " );
						num1 = entradaDeDatos.nextFloat();
						System.out.print("Introduzca el segundo número flotante a restar: " );
						num2 = entradaDeDatos.nextFloat();
						resultado = resta(num1, num2);
						System.out.println("");
						System.out.println("************************************");
						System.out.println("La resta de " + num1 + " y " + num2 + " es " + resultado);
						System.out.println("************************************");
						System.out.println("");
						break;
						
						//Multiplicar
				case "3":		
						System.out.println("");
						System.out.print("Introduzca el primer número flotante a multiplicar: " );
						num1 = entradaDeDatos.nextFloat();
						System.out.print("Introduzca el segundo número flotante a multiplicar: " );
						num2 = entradaDeDatos.nextFloat();
						resultado = multiplicacion(num1, num2);
						System.out.println("");
						System.out.println("************************************");
						System.out.println("La multiplicación de " + num1 + " y " + num2 + " es " + resultado);
						System.out.println("************************************");
						System.out.println("");
						break;
						
						//Dividir	
				case "4":		
						System.out.println("");
						System.out.print("Introduzca el primer número flotante a dividir: " );
						num1 = entradaDeDatos.nextFloat();
						System.out.print("Introduzca el segundo número flotante a dividir: " );
						num2 = entradaDeDatos.nextFloat();
						
						//Condicional if
						if (num2!=0)
						{
							resultado = division(num1, num2);
							System.out.println("");
							System.out.println("*********************************");
							System.out.println("La división de " + num1 + " y " + num2 + " es " + resultado);
							System.out.println("*********************************");
							System.out.println("");
						}
						else
						{
							System.out.println("");
							System.out.println("********************");
							System.out.println("Error división por 0"); 
						  //System.err.println("Error división por 0");
							System.out.println("********************");
							System.out.println("");
						}	
						break;
						
						//Número mayor de 3 números
				case "5":		
						System.out.println("");
						System.out.print("Introduzca el primer número flotante de los 3: " );
						num1 = entradaDeDatos.nextFloat();
						System.out.print("Introduzca el segundo número flotante de los 3: " );
						num2 = entradaDeDatos.nextFloat();
						System.out.print("Introduzca el tercer número flotante de los 3: " );
						num3 = entradaDeDatos.nextFloat();
						
						resultado= mayor(num1, num2, num3);
						
				        System.out.println("");
						System.out.println("*********************************");
						System.out.println("El número " + resultado + " es el mayor de los 3 números");
						System.out.println("*********************************");
						System.out.println("");
						break;
						
						//Factorial
				case "6":
						System.out.println("");
						System.out.println("");
						System.out.print("Introduzca un número para calcular el factorial:" );
						
						int numFactorial=0;
						numFactorial= entradaDeDatos.nextInt();
						resultado= factorial(numFactorial);
						if (resultado>0)
						{
							
							System.out.println("");
							System.out.println("****************************************************");
							System.out.println("El factorial de " + numFactorial + " es " + resultado);
							System.out.println("****************************************************");
							System.out.println("");
						}
						else 
						{
							System.out.println("");
							System.out.println("**********************************************************");
							System.out.println("Error valor inferior a 0, introduzca un valor superior a 0");
							System.out.println("**********************************************************");
							System.out.println("");
						}
						break;
						
				case "0":
					    break;
				default:
					    System.out.println("");
						System.out.println("Opción erronea");
					  //System.err.println("Opción erronea");
						System.out.println("");
						break;
			
			
			}
		} while ( !(opcion.equals("0")));
		System.out.println("");
		System.out.print("El programa ha finalizado");
		System.out.println("");
		
		
		
			

		
		

	}

}
