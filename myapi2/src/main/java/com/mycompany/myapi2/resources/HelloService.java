/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.myapi2.resources;

import javax.ws.rs.FormParam;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.core.Response;

@Path("/hello")
public class HelloService {

    @GET
    @Path("/{param}")
    public Response getMsg(@PathParam("param") String msg) {
        String output = "Jersey say : " + msg;
        return Response.status(200).entity(output).build();
    }

    @GET
    @Path("{year}/{month}/{day}")
    public Response getDate(
            @PathParam("year") int year,
            @PathParam("month") int month,
            @PathParam("day") int day) {

        String date = year + "/" + month + "/" + day;

        return Response.status(200)
                .entity("getDate is called, year/month/day : " + date)
                .build();
    }
    
    @POST  
    @Path("add")  
    public Response addUser(  
        @FormParam("id") int id,  
        @FormParam("name") String name,  
        @FormParam("price") float price) {  
   
        return Response.status(200)  
            .entity(" Product added successfuly!<br> Id: "+id+"<br> Name: " + name+"<br> Price: "+price)  
            .build();  
    }  
    
}
