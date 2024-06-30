import java.util.ArrayList;
import java.util.Scanner;

public class Start {
	
	public static void mostrarUsuarios(BaseDeDatos db)
	{
		System.out.println("*******************************");
		int i=0;
		ArrayList<Usuario> usuarios= new ArrayList<Usuario>();
		
		usuarios= db.R("SELECT * FROM usuarios");
		
		for(i=0; i<usuarios.size(); i++)
		{
			System.out.println(usuarios.get(i).getId() + "--" + usuarios.get(i).getNombre() + "--" + usuarios.get(i).getPassword() + "--" + usuarios.get(i).getEdad() + "--" + usuarios.get(i).getSalario() + "--" + usuarios.get(i).getActivo()); 
		}
		System.out.println("*******************************");
	}
	public static void insertarUsuario(BaseDeDatos db)
	{
		Scanner entradaDeDatos= new Scanner(System.in);
		Usuario u= new Usuario();
		boolean estado= false;
		
		System.out.print("Introduce tu nombre de usuario: ");
		u.setNombre(entradaDeDatos.next());
		System.out.print("Introduce tu password: ");
		u.setPassword(entradaDeDatos.next());
		System.out.print("Introduce tu edad: ");
		u.setEdad(entradaDeDatos.nextInt());
		System.out.print("Introduce tu salario: ");
		u.setSalario(entradaDeDatos.nextFloat());
		
		estado= db.C(u, "usuarios");
		if (!estado)
		{
			System.out.println("Usuario creado correctamente");
		}
		else 
		{
			System.out.println("Se ha producido un error al crear un usuario");
		}
	}
	public static void borrarUsuario(BaseDeDatos db)
	{
		Scanner entradaDeDatos= new Scanner(System.in);
		Usuario u= new Usuario();
		boolean estado= false;
		int id= 0;
		
		mostrarUsuarios(db);
		System.out.println("*******************************");
		System.out.print("Introduce el id del usuario a eliminar: ");
		id= entradaDeDatos.nextInt();
		
		
		estado= db.D("DELETE FROM usuarios WHERE id="+ id);
		if (!estado)
		{
			System.out.println("Borrado correctamente");
		}
		else 
		{
			System.out.println("Se ha producido un error al borrar un usuario");
		}
	}
	public static void modificarUsuario(BaseDeDatos db)
	{
		Scanner entradaDeDatos= new Scanner(System.in);
		Usuario u= new Usuario();
		boolean estado= false;
		
		System.out.print("Introduce el id del usuario: ");
		u.setId(entradaDeDatos.nextInt());
		System.out.print("Introduce tu nombre de usuario: ");
		u.setNombre(entradaDeDatos.next());
		System.out.print("Introduce tu password: ");
		u.setPassword(entradaDeDatos.next());
		System.out.print("Introduce tu edad: ");
		u.setEdad(entradaDeDatos.nextInt());
		System.out.print("Introduce tu salario: ");
		u.setSalario(entradaDeDatos.nextFloat());
		
		estado= db.U(u, "usuarios");
		if (!estado)
		{
			System.out.println("Usuario actualizadp correctamente");
		}
		else 
		{
			System.out.println("Se ha producido un error al actualizar un usuario");
		}
	}
	public static void main(String[] args) {
		// TODO Auto-generated method stub
		
		//CRUD Create Read Update Delete
		Usuario user= new Usuario();
		boolean re= false;
		int opcion= -1;
		
		BaseDeDatos db= new BaseDeDatos("localhost", "ifp", "root", "");
		
		String usuario="";
		String password="";
		Scanner entradaDeDatos= new Scanner(System.in);
		boolean tieneAcceso= false;
		
		System.out.println("****************************************");
		System.out.println("***********GESTOR DE USUARIOS***********");
		System.out.println("****************************************");
		
		do
		{
			System.out.print("Introduce tu nombre de usuario: ");
			usuario= entradaDeDatos.next();
			System.out.print("Introduce tu password: ");
			password= entradaDeDatos.next();
			
			tieneAcceso= db.validar(usuario, password);
			if (!tieneAcceso)
			{
				System.out.println("Lo siento, no tienes Acceso");
			}
			
		}
		while(!tieneAcceso);
		
		System.out.println("Tienes Acceso");	
		
		do {
		System.out.println("****************************************");
		System.out.println("***********GESTOR DE USUARIOS***********");
		System.out.println("****************************************");
		
		System.out.println("Seleccione una opción del menú: ");
		System.out.println("");
		
		System.out.println("1) Crear un nuevo usuario ");
		System.out.println("2) Borrar un usuario ");
		System.out.println("3) Actualizar un usuario ");
		System.out.println("4) Listar usuarios ");
		System.out.println("0) Salir");
		
		System.out.println("");
		System.out.print("Opción: ");
		opcion= entradaDeDatos.nextInt();
		
			if (opcion==1)
			{
//				Crear ususario
				insertarUsuario(db);
			}
			else if (opcion==2)
			{
//				Borrar un usuario
				borrarUsuario(db);
			}
			else if (opcion==3)
			{
//				Modoficar un usuario
				modificarUsuario(db);
			}
			else if (opcion==4)
			{
//				Listar un usuario
				System.out.println("****************************************");
				mostrarUsuarios(db);
				System.out.println("****************************************");
				
			}
			else if (opcion!=0)
			{
				System.out.println("Opción erronea");
			}
		
		}
		while (opcion !=0);
		System.out.println("Fin del programa");
		
		
		
		
		/*mostrarUsuarios(db);
		
		
		user.setNombre("Mofleton");
		user.setPassword("5388");
		user.setEdad(3);
		user.setSalario(500);
		user.setId(6);
		re= db.U(user, "usuarios");
		if (!re)
		{
			System.out.println("Actualizado Correctamente");
		}
		else
		{
			System.out.println("Se ha producido un error en la actualización");
		}
		
		
		/*re= db.D("DELETE FROM usuarios WHERE id=2");
		if (!re)
		{
			System.out.println("Borrado Correctamente");
		}
		else
		{
			System.out.println("Se ha producido un error en el borrado");
		}*/
		
//		mostrarUsuarios(db);
		
		
		
	}

}
