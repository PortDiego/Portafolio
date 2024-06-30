import java.util.Scanner;

public class Start {

	//Funci�n Suma  
	public static float suma(float num1 , float num2)
	{
		float resultado= 0.0f;
		resultado= num1 + num2;
		return resultado; 
	}
	
	//Funci�n Restar
	public static float resta(float num1, float num2)
	{
		float resultado= 0.0f;
		resultado= num1 - num2;
		return resultado;
	}
	
	//Funci�n Multiplicaci�n
	public static float multiplicacion(float num1, float num2)
	{
		float resultado= 0.0f;
		resultado= num1 * num2;
		return resultado;
	}
	
	//Funci�n Divisi�n
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
	
	//Funci�n N�mero mayor de 3 n�meros
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

	//Funci�n Factorial
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
	
	//Otra forma de sacar el factorial de un n�mero con recursividad
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
			//Men� del programa
			System.out.println("Introduzca una opci�n del men�:" );
			System.out.println("1.- Funci�n Sumar");
			System.out.println("2.- Funci�n Restar");
			System.out.println("3.- Funci�n Multiplicar");
			System.out.println("4.- Funci�n Dividir");
			System.out.println("5.- Funci�n N�mero mayor de 3 n�meros");
			System.out.println("6.- Funci�n Factorial");
			System.out.println("0.- Salir");
			System.out.print("Introduzca una opci�n: ");
			opcion = entradaDeDatos.next();
			
			//Condicional switch
			switch(opcion)
			{
				
				case "1":
						//Sumar
						System.out.println("");
						System.out.print("Introduzca el primer n�mero flotante a sumar: " );
						num1 = entradaDeDatos.nextFloat();
						System.out.print("Introduzca el segundo n�mero flotante a sumar: " );
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
						System.out.print("Introduzca el primer n�mero flotante a restar: " );
						num1 = entradaDeDatos.nextFloat();
						System.out.print("Introduzca el segundo n�mero flotante a restar: " );
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
						System.out.print("Introduzca el primer n�mero flotante a multiplicar: " );
						num1 = entradaDeDatos.nextFloat();
						System.out.print("Introduzca el segundo n�mero flotante a multiplicar: " );
						num2 = entradaDeDatos.nextFloat();
						resultado = multiplicacion(num1, num2);
						System.out.println("");
						System.out.println("************************************");
						System.out.println("La multiplicaci�n de " + num1 + " y " + num2 + " es " + resultado);
						System.out.println("************************************");
						System.out.println("");
						break;
						
						//Dividir	
				case "4":		
						System.out.println("");
						System.out.print("Introduzca el primer n�mero flotante a dividir: " );
						num1 = entradaDeDatos.nextFloat();
						System.out.print("Introduzca el segundo n�mero flotante a dividir: " );
						num2 = entradaDeDatos.nextFloat();
						
						//Condicional if
						if (num2!=0)
						{
							resultado = division(num1, num2);
							System.out.println("");
							System.out.println("*********************************");
							System.out.println("La divisi�n de " + num1 + " y " + num2 + " es " + resultado);
							System.out.println("*********************************");
							System.out.println("");
						}
						else
						{
							System.out.println("");
							System.out.println("********************");
							System.out.println("Error divisi�n por 0"); 
						  //System.err.println("Error divisi�n por 0");
							System.out.println("********************");
							System.out.println("");
						}	
						break;
						
						//N�mero mayor de 3 n�meros
				case "5":		
						System.out.println("");
						System.out.print("Introduzca el primer n�mero flotante de los 3: " );
						num1 = entradaDeDatos.nextFloat();
						System.out.print("Introduzca el segundo n�mero flotante de los 3: " );
						num2 = entradaDeDatos.nextFloat();
						System.out.print("Introduzca el tercer n�mero flotante de los 3: " );
						num3 = entradaDeDatos.nextFloat();
						
						resultado= mayor(num1, num2, num3);
						
				        System.out.println("");
						System.out.println("*********************************");
						System.out.println("El n�mero " + resultado + " es el mayor de los 3 n�meros");
						System.out.println("*********************************");
						System.out.println("");
						break;
						
						//Factorial
				case "6":
						System.out.println("");
						System.out.println("");
						System.out.print("Introduzca un n�mero para calcular el factorial:" );
						
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
						System.out.println("Opci�n erronea");
					  //System.err.println("Opci�n erronea");
						System.out.println("");
						break;
			
			
			}
		} while ( !(opcion.equals("0")));
		System.out.println("");
		System.out.print("El programa ha finalizado");
		System.out.println("");
		
		
		
			

		
		

	}

}
