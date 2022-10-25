/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.myapi2.module;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

/**
 *
 * @author trant
 */
public class userdao {

    public static void main(String[] args) {
        try {
            Class.forName("com.mysql.jdbc.Driver");
            Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/myapi", "root", "");
            Statement stmt = conn.createStatement();
            ResultSet rs = stmt.executeQuery("select * from user");
            while (rs.next()) {
                System.out.print(rs.getInt("id") + " ");
                System.out.print(rs.getString("name") + " ");
                System.out.print(rs.getString("email") + " ");
                System.out.print(rs.getURL("picture") + " ");
                System.out.print(rs.getString("location") + " ");
                System.out.print(rs.getTimestamp("createdate") + " ");
            }
        } catch (ClassNotFoundException | SQLException ex) {
            System.out.print(ex.getMessage());
        }
    }
    
    
}
