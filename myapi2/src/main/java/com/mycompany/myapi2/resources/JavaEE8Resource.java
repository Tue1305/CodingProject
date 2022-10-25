package com.mycompany.myapi2.resources;

import com.mycompany.myapi2.module.user;
import com.mycompany.myapi2.module.userparam;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.Timestamp;
import java.time.Instant;
import java.util.ArrayList;
import java.util.List;
import javax.ws.rs.Consumes;
import javax.ws.rs.DELETE;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.GenericEntity;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;

/**
 *
 * @author
 */
@Path("user")
public class JavaEE8Resource {

    @GET
    public Response ping() {
        return Response
                .ok("ping")
                .build();
    }

    @Path("getUser")
    @GET
    public Response getUser() {
        user a = new user(1, "tue", "tue@gnail.com", "", "", Timestamp.from(Instant.now()));
        return Response
                .status(Response.Status.OK)
                .entity(a)
                .type(MediaType.APPLICATION_JSON)
                .build();
    }

    @Path("create")
    @POST
    @Consumes("application/json")
    @Produces("application/json")
    public Response Users(userparam json) {
        System.out.println(json.toString());
        try {
            Class.forName("com.mysql.jdbc.Driver");
            Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/myapi", "root", "1234");

            String sql = " insert into user (name, email, picture, location)"
                    + " values (?, ?, ?, ?)";
            PreparedStatement preparedStmt = conn.prepareStatement(sql);
            preparedStmt.setString(1, json.getName());
            preparedStmt.setString(2, json.getEmail());
            preparedStmt.setString(3, "");
            preparedStmt.setString(4, json.getLocation());
            preparedStmt.execute();
            preparedStmt.close();

            sql = "Select * from user where email = ?";
            PreparedStatement preparedStmt2 = conn.prepareStatement(sql);
            preparedStmt2.setString(1, json.getEmail());
            ResultSet rs = preparedStmt2.executeQuery();
            if (rs.next()) {
                user b = new user(rs.getInt("id"), rs.getString("name"), rs.getString("email"), rs.getString("picture"),
                        rs.getString("location"), rs.getTimestamp("createdate"));
                preparedStmt2.close();
                rs.close();
                conn.close();
                return Response
                        .status(Response.Status.OK)
                        .entity(b)
                        .type(MediaType.APPLICATION_JSON)
                        .build();
            }
            conn.close();

        } catch (ClassNotFoundException | SQLException ex) {
            System.out.print(ex.getMessage());
            return Response
                    .ok(ex.getMessage())
                    .build();
        }
        return Response
                .ok("error")
                .build();
    }

    @Path("list")
    @GET
    @Produces("application/json")
    public Response getAllRecords() {
        List<user> list;
        list = new ArrayList<>();

        try {
            Class.forName("com.mysql.jdbc.Driver");
            Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/myapi", "root", "1234");
            String sql = "Select * From user";
            PreparedStatement ps = conn.prepareStatement(sql);
            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                user newUser = new user(rs.getInt("id"), rs.getString("name"),
                        rs.getString("email"), rs.getString("picture"),
                        rs.getString("location"), rs.getTimestamp("createdate"));
                list.add(newUser);
            }
            GenericEntity<List<user>> entity = new GenericEntity<List<user>>(list) {
            };
            rs.close();
            ps.close();
            conn.close();
            return Response
                    .ok(entity)
                    .build();
        } catch (ClassNotFoundException | SQLException ex) {
            System.out.print(ex.getMessage());
            return Response
                    .ok(ex.getMessage())
                    .build();
        }
    }

    @Path("delete/{id}")
    @DELETE
    @Consumes("application/json")
    public Response deleteUser(@PathParam("id") int id) {
        try {
            Class.forName("com.mysql.jdbc.Driver");
            Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/myapi", "root", "1234");
            String sql = "Delete from user where id = " + id;
            Statement ps = conn.createStatement();
            ps.executeUpdate(sql);
            ps.close();
            conn.close();
            System.out.println("Id is deleted: " + id);
            return Response.ok("Success").build();

        } catch (ClassNotFoundException | SQLException ex) {
            System.out.print(ex.getMessage());
            return Response
                    .ok(ex.getMessage())
                    .build();
        }
    }

    @Path("update/{id}")
    @PUT
    @Consumes("application/json")
    public Response updateUsers(userparam json, @PathParam("id") int id) {
        System.out.println(json.toString());
        try {
            Class.forName("com.mysql.jdbc.Driver");
            Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/myapi", "root", "1234");
            String sql = "Update user set name = ?, email = ? where id = " + id;
            PreparedStatement stmt2 = conn.prepareStatement(sql);
            stmt2.setString(1, json.getName());
            stmt2.setString(2, json.getEmail());
            System.out.print(sql);
            stmt2.executeUpdate();
            stmt2.close();
            conn.close();
            System.out.println("Id is updated: " + id);
            return Response.ok("Success").build();
        } catch (ClassNotFoundException | SQLException ex) {
            System.out.print(ex.getMessage());
            return Response
                    .ok(ex.getMessage())
                    .build();
        }
    }

}
