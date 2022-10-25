<%-- 
    Document   : login
    Created on : 8-Jul-2022, 11:53:51 AM
    Author     : trant
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="com.mycompany.myjsp.User"%>
<jsp:useBean id="u" class="com.mycompany.myjsp.User"></jsp:useBean>  
<jsp:setProperty property="*" name="u"/>  
<!DOCTYPE html>



<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body{
                font: 14px sans-serif;
            }
            .wrapper{

                padding: 20px;
                max-width: 500px;
                margin: auto;
                background-color: wheat;
                margin-top: 150px;
            }
        </style>
    </head>
    <body>


        <div class="wrapper">
            <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>



            <form action = "validate.jsp" method = "POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control"/>
                    <br/>
                </div>    
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control"/>
                    <br/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
                <p>Don't have an account? <a href="adduserform.jsp">Sign up now</a>.</p>
                <p>View Record<a href="viewusers.jsp" class="btn btn-danger ml-3">View Users</a></p>  
            </form>
        </div>
    </body>
</html>
