import java.awt.CardLayout;
import java.awt.Color;
import java.awt.event.*;
import javax.swing.*;

public class InventoryManagementSystem
{
    private JFrame loginPageFrame;
    private CardLayout cardLayout = new CardLayout();

    private JPanel loginPageFramePanel, loginPanel, emailPanel, passwordPanel, registerAndLoginPanel, userManagementPanel, categoryPanel;

    private JLabel emailLabel, passwordLabel;
    private JTextField emailTextField, passTextField;
    private JButton registerButton, loginButton;


    public JPanel createPanel(int x, int y, int width, int height, Color color)
    {
        JPanel panel = new JPanel();

        panel.setBounds(x, y, width, height);
        panel.setBackground(color);
        panel.setLayout(null);

        return panel;
    }

    public JLabel createLabel(String text, int x, int y, int width, int height, Color color, int horAlign, int verAlign)
    {
        JLabel label = new JLabel();

        label.setText(text);
        label.setBounds(x, y, width, height);

        label.setHorizontalAlignment(horAlign);
            if(horAlign == 0)
            {
                label.setHorizontalAlignment(JLabel.CENTER);
            }
            else if(horAlign == 2)
            {
                label.setHorizontalAlignment(JLabel.LEFT);
            }
            else if(horAlign == 4)
            {
                label.setHorizontalAlignment(JLabel.RIGHT);
            }

        label.setVerticalAlignment(verAlign);
            if(verAlign == 0)
            {
                label.setVerticalAlignment(JLabel.CENTER);
            }
            else if(verAlign == 1)
            {
                label.setVerticalAlignment(JLabel.TOP);
            }
            else if(verAlign == 3)
            {
                label.setVerticalAlignment(JLabel.BOTTOM);
            }
            
        label.setForeground(color);
        label.setLayout(null);

        return label;
    }

    public JTextField createTextField(int x, int y, int width, int height)
    {
        JTextField textField = new JTextField();

        textField.setBounds(x, y, width, height);
        textField.setBackground(Color.WHITE);
        textField.setLayout(null);

        return textField;
    } 

    public JButton createButton(String text, int x, int y, int width, int height, Color foregroundColor, Color backgroundColor)
    {
        JButton button = new JButton();

        button.setText(text);
        button.setBounds(x, y, width, height);
        button.setForeground(foregroundColor);
        button.setBackground(backgroundColor);
        button.setLayout(null);

        return button;
    }

    InventoryManagementSystem()
    {
        loginPageFrame = new JFrame("Inventory");

        //PRE-LOG IN
        loginPageFramePanel = createPanel(0, 0, 1280, 1024, Color.BLUE);
        loginPageFramePanel.setLayout(cardLayout);
        
        loginPanel = createPanel(320, 200, 600, 600, Color.BLACK);
        emailPanel = createPanel(0, 175, 600, 100, Color.YELLOW);
        passwordPanel = createPanel(0, 275, 600, 55, Color.YELLOW);
        registerAndLoginPanel = createPanel(0, 330, 600, 50, Color.YELLOW);

        emailLabel = createLabel("Email", 0, 20, 300, 300, Color.WHITE, 0 , 1);
        passwordLabel = createLabel("Password", 15, 0, 300, 300, Color.WHITE, 0, 1);

        emailTextField = createTextField(135, 50, 300, 25);
        passTextField = createTextField(135, 30, 300, 25);

        registerButton = createButton("Register", 135, 10, 100, 25, Color.WHITE, Color.GREEN);
        loginButton = createButton("Log in", 335, 10, 100, 25, Color.WHITE, Color.GREEN);

        //POST-LOG IN
        userManagementPanel = createPanel(0, 0, 1280, 1024, Color.RED);
        userManagementPanel.setLayout(cardLayout);
        categoryPanel = createPanel(0, 0, 1280, 100, Color.WHITE);


        loginPageFrame.add(loginPageFramePanel);

        loginPageFramePanel.add(loginPanel);
        loginPanel.add(emailPanel);
        loginPanel.add(passwordPanel);
        loginPanel.add(registerAndLoginPanel);

        emailPanel.add(emailLabel);
        emailPanel.add(emailTextField);
        passwordPanel.add(passwordLabel);
        passwordPanel.add(passTextField);

        registerAndLoginPanel.add(registerButton);
        registerAndLoginPanel.add(loginButton);

        cardLayout.show(loginPageFramePanel, "1");

        registerButton.addActionListener(new ActionListener() 
        {
            public void actionPerformed(ActionEvent e)
            {

            }
        });
        
        loginButton.addActionListener(new ActionListener() 
        {
            public void actionPerformed(ActionEvent e)
            {
                cardLayout.show(userManagementPanel, "2");
            }
        });

        loginPageFrame.setSize(1280, 1024);
        loginPageFrame.setLocationRelativeTo(null);  
        loginPageFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        loginPageFrame.pack();
        loginPageFrame.setVisible(true);
    }

    public static void main(String[] args) {
        new InventoryManagementSystem();
    }
}