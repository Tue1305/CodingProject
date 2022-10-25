<%@page import="com.mycompany.myjsp.UserDao"%>
<%@page import="java.sql.ResultSet"%>
<%@page import="java.sql.PreparedStatement"%>
<%@page import="java.sql.DriverManager"%>
<%@page import="java.sql.Connection"%>
<%@page import="com.mycompany.myjsp.User"%>
<!DOCTYPE html>  
<html>  
    <head>  
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">  
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>JSP CRUD Example</title>  
    </head>  
    <body>  
        <h1 style="margin-left: 10px;">JSP CRUD Example</h1>  
        <h1 style="margin-left: 10px;" class="my-5">Hi, <%= request.getParameter("username")%>. Welcome to our site.</h1>
        <h1 style="margin-left: 10px;" class="my-5">Password: <%= request.getParameter("password")%></h1>
        <div class="mt-5 mb-3 clearfix"> 
        <a style="margin-left: 10px;" href="logout.jsp" class="btn btn-danger pull-left">Log out</a> 
        <a style="margin-left: 10px;" href="adduserform.jsp" class="btn btn-success pull-left"><i class="fa fa-plus"></i> Add New User</a> 
        <a style="margin-left: 10px;" href="viewusers.jsp" class="btn btn-danger pull-left">View Users</a>  
        </div>
<%        
if(null == session.getAttribute("username")){
  // User is not logged in.
%>
<jsp:forward page="login.jsp"></jsp:forward>    
<%
}else{
%>

<%
  // User IS logged in.
}
%>


    </body>  
</html>  