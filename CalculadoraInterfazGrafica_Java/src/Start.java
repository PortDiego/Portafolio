import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JTextField;
import javax.swing.JButton;
import java.awt.Font;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import javax.swing.SwingConstants;

public class Start {

	private JFrame frame;
	private JTextField caja1;
	private JButton botonC;
	private JButton botonPar;
	private JButton botonSumar;
	private JButton botonRestar;
	private JButton botonMulti;
	private JButton botonDividir;
	private JButton botonIgual;
	private JButton boton0;
	private JButton boton1;
	private JButton boton2;
	private JButton boton3;
	private JButton boton4;
	private JButton boton5;
	private JButton boton6;
	private JButton boton7;
	private JButton boton8;
	private JButton boton9;
	private String numero1;
	private String numero2;
	private String signo;
	

	/**
	 * Launch the application.
	 */
	public void bloquearTodo(boolean estado)
	{
		botonSumar.setEnabled(estado);
		botonRestar.setEnabled(estado);
		botonMulti.setEnabled(estado);
		botonDividir.setEnabled(estado);
		botonPar.setEnabled(estado);
		botonIgual.setEnabled(estado);
		boton0.setEnabled(estado);
		boton1.setEnabled(estado);
		boton2.setEnabled(estado);
		boton3.setEnabled(estado);
		boton4.setEnabled(estado);
		boton5.setEnabled(estado);
		boton6.setEnabled(estado);
		boton7.setEnabled(estado);
		boton8.setEnabled(estado);
		boton9.setEnabled(estado);
	}
	public void bloquearOperaciones()
	{
		botonSumar.setEnabled(false);
		botonRestar.setEnabled(false);
		botonMulti.setEnabled(false);
		botonDividir.setEnabled(false);
		botonPar.setEnabled(false);
	}
	
	
	public static String operacion(String numero1, String signo, String numero2) 
	{
		float total = 0.0f;
		String resultado="";
		if (signo.equals("%"))
		{
			if (Float.parseFloat(numero1) % 2==0)
			{
				return ("PAR");
				
			}
			else 
			{
				return ("IMPAR");
			}
		}
		if (signo.equals("+"))
		{
			total= Float.parseFloat(numero1) + Float.parseFloat(numero2);
		}
		if (signo.equals("-"))
		{
			total= Float.parseFloat(numero1) - Float.parseFloat(numero2);
		}
		if (signo.equals("*"))
		{
			total= Float.parseFloat(numero1) * Float.parseFloat(numero2);
		}
		if (signo.equals("/"))
		{
			if (!numero2.equals("0"))
			{
				total= Float.parseFloat(numero1) / Float.parseFloat(numero2);
			}
			else 
			{
				return ("Indeterminado");
			}
		}
		resultado= Float.toString(total);
		return resultado;

	}
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					Start window = new Start();
					window.frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the application.
	 */
	public Start() {
		initialize();
	}

	/**
	 * Initialize the contents of the frame.
	 */
	private void initialize() {
		frame = new JFrame();
		frame.setBounds(100, 100, 421, 620);
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frame.getContentPane().setLayout(null);
		
		caja1 = new JTextField();
		caja1.setEditable(false);
		caja1.setHorizontalAlignment(SwingConstants.RIGHT);
		caja1.setFont(new Font("Tahoma", Font.PLAIN, 30));
		caja1.setBounds(41, 37, 326, 60);
		frame.getContentPane().add(caja1);
		caja1.setColumns(10);
		
		botonC = new JButton("C");
		botonC.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				numero1="";
				numero2="";
				signo="";
				bloquearTodo(true);
				caja1.setText("");
			}
		});
		botonC.setFont(new Font("Tahoma", Font.PLAIN, 14));
		botonC.setBounds(41, 148, 66, 72);
		frame.getContentPane().add(botonC);
		
		botonPar = new JButton("Par");
		botonPar.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				String total="";
				numero1= caja1.getText();
				if (!caja1.getText().equals(""))
				{
					numero1= caja1.getText();
					signo= "%";
					caja1.setText("");
					bloquearOperaciones();
				}
				
				if (!numero1.equals(""))
				{
					total= operacion(numero1, signo, numero2);
					caja1.setText(total);}
			}
		});
		botonPar.setFont(new Font("Tahoma", Font.PLAIN, 14));
		botonPar.setBounds(117, 148, 91, 72);
		frame.getContentPane().add(botonPar);
		
		boton1 = new JButton("1");
		boton1.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				caja1.setText(caja1.getText() + "1");
			}
		});
		boton1.setFont(new Font("Tahoma", Font.PLAIN, 16));
		boton1.setBounds(41, 247, 58, 60);
		frame.getContentPane().add(boton1);
		
		boton2 = new JButton("2");
		boton2.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				caja1.setText(caja1.getText() + "2");
			}
		});
		boton2.setFont(new Font("Tahoma", Font.PLAIN, 16));
		boton2.setBounds(115, 247, 58, 60);
		frame.getContentPane().add(boton2);
		
		boton3 = new JButton("3");
		boton3.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				caja1.setText(caja1.getText() + "3");
			}
		});
		boton3.setFont(new Font("Tahoma", Font.PLAIN, 16));
		boton3.setBounds(192, 247, 58, 60);
		frame.getContentPane().add(boton3);
		
		botonSumar = new JButton("+");
		botonSumar.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				if (!caja1.getText().equals(""))
				{
					numero1= caja1.getText();
					signo= "+";
					caja1.setText("");
					bloquearOperaciones();
				}
				
			}
		});
		botonSumar.setFont(new Font("Tahoma", Font.PLAIN, 16));
		botonSumar.setBounds(305, 247, 58, 60);
		frame.getContentPane().add(botonSumar);
		
		boton4 = new JButton("4");
		boton4.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				caja1.setText(caja1.getText() + "4");
			}
		});
		boton4.setFont(new Font("Tahoma", Font.PLAIN, 16));
		boton4.setBounds(41, 330, 58, 60);
		frame.getContentPane().add(boton4);
		
		boton5 = new JButton("5");
		boton5.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				caja1.setText(caja1.getText() + "5");
			}
		});
		boton5.setFont(new Font("Tahoma", Font.PLAIN, 16));
		boton5.setBounds(115, 330, 58, 60);
		frame.getContentPane().add(boton5);
		
		boton6 = new JButton("6");
		boton6.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				caja1.setText(caja1.getText() + "6");
			}
		});
		boton6.setFont(new Font("Tahoma", Font.PLAIN, 16));
		boton6.setBounds(192, 330, 58, 60);
		frame.getContentPane().add(boton6);
		
		botonRestar = new JButton("-");
		botonRestar.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				if (!caja1.getText().equals(""))
				{
					numero1= caja1.getText();
					signo= "-";
					caja1.setText("");
					bloquearOperaciones();
				}
				
				
			}
		});
		botonRestar.setFont(new Font("Tahoma", Font.PLAIN, 16));
		botonRestar.setBounds(305, 330, 58, 60);
		frame.getContentPane().add(botonRestar);
		
		boton7 = new JButton("7");
		boton7.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				caja1.setText(caja1.getText() + "7");
			}
		});
		boton7.setFont(new Font("Tahoma", Font.PLAIN, 16));
		boton7.setBounds(41, 415, 58, 60);
		frame.getContentPane().add(boton7);
		
		boton8 = new JButton("8");
		boton8.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				caja1.setText(caja1.getText() + "8");
			}
		});
		boton8.setFont(new Font("Tahoma", Font.PLAIN, 16));
		boton8.setBounds(117, 415, 58, 60);
		frame.getContentPane().add(boton8);
		
		boton9 = new JButton("9");
		boton9.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				caja1.setText(caja1.getText() + "9");
			}
		});
		boton9.setFont(new Font("Tahoma", Font.PLAIN, 16));
		boton9.setBounds(192, 415, 58, 60);
		frame.getContentPane().add(boton9);
		
		botonMulti = new JButton("*");
		botonMulti.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				if (!caja1.getText().equals(""))
				{
					numero1= caja1.getText();
					signo= "*";
					caja1.setText("");
					bloquearOperaciones();
				}
				
				
			}
		});
		botonMulti.setFont(new Font("Tahoma", Font.PLAIN, 16));
		botonMulti.setBounds(305, 415, 58, 60);
		frame.getContentPane().add(botonMulti);
		
		botonDividir = new JButton("/");
		botonDividir.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				if (!caja1.getText().equals(""))
				{
					numero1= caja1.getText();
					signo= "/";
					caja1.setText("");
					bloquearOperaciones();
				}
				
				
				
			}
		});
		botonDividir.setFont(new Font("Tahoma", Font.PLAIN, 16));
		botonDividir.setBounds(305, 501, 58, 60);
		frame.getContentPane().add(botonDividir);
		
		boton0 = new JButton("0");
		boton0.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				caja1.setText(caja1.getText() + "0");
			}
		});
		boton0.setFont(new Font("Tahoma", Font.PLAIN, 16));
		boton0.setBounds(41, 501, 58, 60);
		frame.getContentPane().add(boton0);
		
		botonIgual = new JButton("=");
		botonIgual.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				String total="";
				
				try
				{
					numero2= caja1.getText();
					total= operacion(numero1, signo, numero2);
					caja1.setText(total);
					bloquearTodo(false);
				}
				catch (Exception a)
				{
					caja1.getText().equals("");
					caja1.setText("Error");
					bloquearTodo(false);
				}
				
			}
		});
		botonIgual.setFont(new Font("Tahoma", Font.PLAIN, 16));
		botonIgual.setBounds(117, 501, 133, 60);
		frame.getContentPane().add(botonIgual);
	}

}
