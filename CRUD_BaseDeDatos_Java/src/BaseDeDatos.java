import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

import com.mysql.jdbc.Connection;
import com.mysql.jdbc.Statement;

public class BaseDeDatos {
	
	private String servidor;
	private String usuario;
	private String nombreBD;
	private String password;
	
	
	public BaseDeDatos (String servidor, String nombreBD, String usuario, String password)
	{
		this.servidor= servidor;
		this.usuario= usuario;
		this.nombreBD= nombreBD;
		this.password= password;
		
		try {
			DriverManager.registerDriver(new org.gjt.mm.mysql.Driver());
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
	public boolean validar(String user, String pass)
	{
		ArrayList<Usuario> l= new ArrayList<Usuario>();
		l= R("SELECT * FROM usuarios where nombre= '"+user+"' and password= '"+pass+"' LIMIT 0,1");
		
		if (l.size()==0)
		{
			return false;
		}
		return true;
	}
	public boolean C(Usuario u, String tabla)
	{
		boolean result= false;
		String consulta= "";
		Connection conexion= null;
		Statement s= null;
		try {
			conexion = (Connection) DriverManager.getConnection("jdbc:mysql://" +this.servidor+"/"+this.nombreBD, usuario, password );
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		try {
			s = (Statement) conexion.createStatement();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		try {
			consulta= "INSERT INTO " + tabla + "(nombre, password, edad, salario, activo) VALUES ('"+ u.getNombre()+ "', '"+ u.getPassword()+ "',  "+ u.getEdad()+ ", "+ u.getSalario()+", "+ u.getActivo()+ ")"; 
			
			result = s.execute(consulta);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return result;
		
	}
	public ArrayList<Usuario> R(String consulta)
	{
		int contador= 0;
		Usuario u= null;
		ArrayList <Usuario> alu= new ArrayList<Usuario>();
		
		Connection conexion= null;
		Statement s= null;
//		Se establece la conexion con la BD
		try {
			conexion = (Connection) DriverManager.getConnection("jdbc:mysql://" +this.servidor+"/"+this.nombreBD, usuario, password );
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
//		Se crea un objeto s para establecer consultas
		try {
			s = (Statement) conexion.createStatement();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
//		Se crea la consulta con executeQuery que devuelve una serie de resultados 
		ResultSet rs= null;
		try {
			rs = s.executeQuery(consulta);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		try {
			while (rs.next()) 
			{
				u= new Usuario();
				u.setId(rs.getInt("id"));
				u.setNombre(rs.getString("nombre"));
				u.setPassword(rs.getString("password"));
				u.setEdad(rs.getInt("edad"));
				u.setSalario(rs.getFloat("salario"));
				u.setActivo(rs.getBoolean("activo"));
				
				alu.add(u);
				
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		try {
			conexion.close();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		
		return alu;
	}
	public boolean U(Usuario u, String tabla)
	{
		boolean result= false;
		String consulta= "";
		Connection conexion= null;
		Statement s= null;
		try {
			conexion = (Connection) DriverManager.getConnection("jdbc:mysql://" +this.servidor+"/"+this.nombreBD, usuario, password );
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		try {
			s = (Statement) conexion.createStatement();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		try {
			consulta= "UPDATE " + tabla + " SET nombre= '"+ u.getNombre()+ "', password='"+ u.getPassword()+ "',  edad="+ u.getEdad()+ ", salario="+ u.getSalario()+", activo="+ u.getActivo()+ " WHERE id=" + u.getId(); 
			System.out.println(consulta);
			result = s.execute(consulta);
			
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return result;
	}
	public boolean D(String consulta)
	{
		boolean result= false;
		Connection conexion= null;
		Statement s= null;
		try {
			conexion = (Connection) DriverManager.getConnection("jdbc:mysql://" +this.servidor+"/"+this.nombreBD, usuario, password );
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		try {
			s = (Statement) conexion.createStatement();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		try {
			result = s.execute(consulta);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return result;
	}
	
	

}
