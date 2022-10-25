<%-- 
    Document   : logout
    Created on : 13-Jul-2022, 10:58:02 AM
    Author     : trant
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">  
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>Successfully log out </h1>
        <a href="login.jsp"class="btn btn-danger ml-3"> Log in</a>
        <%
            session.removeAttribute("username");
         %>
    </body>
</html>
