import java.util.Scanner;

public class Start {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		Scanner entradaDeDatos = new Scanner(System.in);
		
		
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
			System.out.println("1.- Sumar");
			System.out.println("2.- Restar");
			System.out.println("3.- Multiplicar");
			System.out.println("4.- Dividir");
			System.out.println("5.- N�mero mayor de 3 n�meros");
			System.out.println("6.- Capic�a");
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
						resultado = num1 + num2;
						System.out.println("");
						System.out.println("***********************************");
						System.out.println("La suma de " + num1 + " y " + num2 + " es " + resultado);
						System.out.println("***********************************");
						System.out.println("");
						break;
						
						//Restar
				case "2":
						System.out.println("");
						System.out.print("Introduzca el primer n�mero flotante a restar: " );
						num1 = entradaDeDatos.nextFloat();
						System.out.print("Introduzca el segundo n�mero flotante a restar: " );
						num2 = entradaDeDatos.nextFloat();
						resultado = num1 - num2;
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
						resultado = num1 * num2;
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
							resultado = num1 / num2;
							System.out.println("");
							System.out.println("*********************************");
							System.out.println("La divisi�n de " + num1 + " y " + num2 + " es " + resultado);
							System.out.println("*********************************");
							System.out.println("");
						}
						else
						{
							System.out.println("");
							System.out.println("Error divisi�n por 0");
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
						
						//Condicional if con anidamiento
						
						/* Otra forma de hacerlo
						 * if ((num1 > num2) && (num1 > num3))
						{
							
							System.out.println("");
							System.out.println("*********************************");
							System.out.println("El n�mero " + num1 + " es el mayor de los 3 n�meros");
							System.out.println("*********************************");
							System.out.println("");
							
					
						{

						else if (num2 > num3) 
							{
							System.out.println("");
							System.out.println("*********************************");
							System.out.println("El n�mero " + num2 + " es el mayor de los 3 n�meros");
							System.out.println("*********************************");
							System.out.println("");
							}
							
						else {	
						    {
							System.out.println("");
							System.out.println("*********************************");
							System.out.println("El n�mero " + num3 + " es el mayor de los 3 n�meros");
							System.out.println("*********************************");
							System.out.println("");
							}
						
								
						}*/
							
						if (num1 > num2)
						{
							if (num1 > num3)
							{
								System.out.println("");
								System.out.println("*********************************");
								System.out.println("El n�mero " + num1 + " es el mayor de los 3 n�meros");
								System.out.println("*********************************");
								System.out.println("");
							}
							else
							{
								System.out.println("");
								System.out.println("*********************************");
								System.out.println("El n�mero " + num3 + " es el mayor de los 3 n�meros");
								System.out.println("*********************************");
								System.out.println("");
							}
						
						}
						else 
						{

							if (num2 > num3) 
							{
								System.out.println("");
								System.out.println("*********************************");
								System.out.println("El n�mero " + num2 + " es el mayor de los 3 n�meros");
								System.out.println("*********************************");
								System.out.println("");
							}
							else 
							{
								System.out.println("");
								System.out.println("*********************************");
								System.out.println("El n�mero " + num3 + " es el mayor de los 3 n�meros");
								System.out.println("*********************************");
								System.out.println("");
							}
						
								
						}
						break;
						
						//Capic�a
				case "6":
						System.out.println("");
						System.out.println("");
						System.out.print("Introduzca un n�mero para saber si es capic�a:" );
						int numero= 0;
						String num= String.valueOf(numero);
						num= entradaDeDatos.next();
						int i= 0; 
						int j= 0;
						
						//Bucle for
						for (i=0, j= num.length()-1; i<=j; i++, j=-1) 
						{
	                         if (num.charAt(i) != num.charAt(j)) 
							 {
	                        	System.out.println("");
	                        	System.out.println("*************");
								System.out.println("NO es capic�a");
								System.out.println("*************");
								System.out.println("");
							 }
							 else 
							 {
								System.out.println(""); 
								System.out.println("*************");
								System.out.println("SI es capic�a");
								System.out.println("*************");
								System.out.println("");
							 }
						}
						break;
						
				case "0":
					    break;
				default:
					    System.out.println("");
						System.out.println("Opci�n erronea");
						System.out.println("");
						break;
			
			
			}
		} while ( !(opcion.equals("0")));
		System.out.println("");
		System.out.print("El programa ha finalizado");
		System.out.println("");
		
		
		
			

		
		

	}

}
