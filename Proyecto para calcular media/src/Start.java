import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JLabel;
import java.awt.Font;
import javax.swing.JTextField;
import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;

public class Start {

	private JFrame frame;
	private JTextField box1;
	private JTextField box2;
	private JTextField box3;
	private JLabel label1;
	private JLabel label2;
	private JLabel label3;
	private JLabel label4;
	private JLabel label5;
	private JLabel etiqueta6;
	
	private String nota1;
	private String nota2;
	private String nota3;
	private float n1;
	private float n2;
	private float n3;
	private float media;
	private String mediaNota;
	private JButton button1;

	/**
	 * Launch the application.
	 */
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
		frame.setBounds(100, 100, 647, 454);
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frame.getContentPane().setLayout(null);
		
		label1 = new JLabel("Calcular Media Alumno");
		label1.setFont(new Font("Tahoma", Font.PLAIN, 18));
		label1.setBounds(119, 31, 189, 13);
		frame.getContentPane().add(label1);
		
		label2 = new JLabel("Matematicas");
		label2.setBounds(55, 83, 189, 18);
		frame.getContentPane().add(label2);
		
		label3 = new JLabel("Literatura");
		label3.setBounds(55, 111, 189, 18);
		frame.getContentPane().add(label3);
		
		label4 = new JLabel("Geografia");
		label4.setBounds(55, 139, 189, 21);
		frame.getContentPane().add(label4);
		
		box1 = new JTextField();
		box1.setBounds(403, 83, 96, 19);
		frame.getContentPane().add(box1);
		box1.setColumns(10);
		
		box2 = new JTextField();
		box2.setBounds(403, 111, 96, 19);
		frame.getContentPane().add(box2);
		box2.setColumns(10);
		
		box3 = new JTextField();
		box3.setBounds(403, 140, 96, 19);
		frame.getContentPane().add(box3);
		box3.setColumns(10);
		
		label5 = new JLabel("Nota Media");
		label5.setBounds(131, 243, 113, 13);
		frame.getContentPane().add(label5);
		
		etiqueta6 = new JLabel("");
		etiqueta6.setFont(new Font("Tahoma", Font.PLAIN, 16));
		etiqueta6.setBounds(254, 229, 150, 39);
		frame.getContentPane().add(etiqueta6);
		
		button1 = new JButton("Calcular Media");
		button1.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				
				nota1= box1.getText().toString();
				nota2= box2.getText().toString();
				nota3= box3.getText().toString();
				
				if(nota1.equals("") || nota2.equals("") ||nota3.equals(""))
				{
					etiqueta6.setText("Todos los campos son obligatorios");
				}
				else 
				{
					n1= Integer.parseInt(nota1);
					n2= Integer.parseInt(nota2);
					n3= Integer.parseInt(nota3);
					
					media= (n1 + n2 + n3) / (3.0f);
					media= (n1+n2+n3) / 3.0f;
					mediaNota= Float.toString(media);
					etiqueta6.setText(mediaNota);
				}
				
			}
		});
		button1.setFont(new Font("Tahoma", Font.PLAIN, 9));
		button1.setBounds(254, 181, 96, 21);
		frame.getContentPane().add(button1);
	}

}
