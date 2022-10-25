/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.myapi2.resources;

import java.io.File;  
import javax.ws.rs.GET;  
import javax.ws.rs.Path;  
import javax.ws.rs.Produces;  
import javax.ws.rs.core.Response;  
import javax.ws.rs.core.Response.ResponseBuilder;  
@Path("/files")  
public class FileDownloadService {  
    private static final String FILE_PATH = "c:\\devlist.txt";  
    @GET  
    @Path("/txt")  
    @Produces("text/plain")  
    public Response getFile() {  
        File file = new File(FILE_PATH);  
   
        ResponseBuilder response = Response.ok((Object) file);  
        response.header("Content-Disposition","attachment; filename=\"javatpoint_file.txt\"");  
        return response.build();  
   
    }  
 }  
