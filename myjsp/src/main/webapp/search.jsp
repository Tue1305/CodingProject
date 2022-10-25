<%@page import="java.sql.PreparedStatement"%>
<%@page import="java.util.List"%>
<%@page import="java.util.List"%>
<%@page import="com.mycompany.myjsp.UserDao"%>
<%@page import="java.sql.DriverManager"%>
<%@page import="java.sql.ResultSet"%>
<%@page import="java.sql.Statement"%>
<%@page import="java.sql.Connection"%>
<%@page import="com.mycompany.myjsp.User"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ page import ="java.sql.*" %>
<%@page import="com.mycompany.myjsp.UserDao,com.mycompany.myjsp.User"%>  
<%@page import="com.mycompany.myjsp.UserDao,com.mycompany.myjsp.*,java.util.*"%> 

<!DOCTYPE html>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


        <link rel="stylesheet" href="button.css">         
        <title>Search Data</title>
    </head>
    <body>

        <%
            String id = request.getParameter("id");
            User u = UserDao.getRecordById(Integer.parseInt(id));
            List<User> list = UserDao.getAllRecords();
            request.setAttribute("list", list);
        %> 
        <form method="post" action="index.jsp">


            <h1 style="text-align: center;">Search Data</h1>
            <table border="1" class="table table-bordered table-striped">
                <th>Id</th>
                <th>Name</th>
                <th>Password</th>
                <th>Email</th>  
                <th>Sex</th>
                <th>Country</th>
                <th>Edit</th>   
                <th>Delete</th>


                <%
                    Class.forName("com.mycompany.myjsp.User").newInstance();
                    Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/sample", "root", "1234");

                    Statement st = con.createStatement();
                    ResultSet rs;

                    PreparedStatement ps = con.prepareStatement("select * from register where id=? OR name=? OR password=? OR  email=? OR sex=? OR country=?");
                    ps.setString(1, request.getParameter("id"));
                    ps.setString(2, request.getParameter("username"));
                    ps.setString(3, request.getParameter("password"));
                    ps.setString(4, request.getParameter("email"));
                    ps.setString(5, request.getParameter("sex"));
                    ps.setString(6, request.getParameter("location"));

                    rs = ps.executeQuery();
                    while (rs.next()) {
                        out.println("<c:forEach items='${list}' var='u'>");
                        out.println("<tr>");
                        out.println("<form action='index.jsp'>");
                        out.println("<td>" + rs.getString("id") + "<input type='hidden' name='id' value='" + rs.getString("id") + "'></td>");
                        out.println("<td>" + rs.getString("name") + "<input type='hidden' name='username' value='" + rs.getString("name") + "'></td>");
                        out.println("<td>" + rs.getString("password") + "<input type='hidden' name='password' value='" + rs.getString("password") + "'></td>");
                        out.println("<td>" + rs.getString("email") + "<input type='hidden' name='email' value='" + rs.getString("email") + "'></td>");
                        out.println("<td>" + rs.getString("sex") + "<input type='hidden' name='sex' value='" + rs.getString("sex") + "'></td>");
                        out.println("<td>" + rs.getString("country") + "<input type='hidden' name='country' value='" + rs.getString("country") + "'></td>");

                        out.println("<td><a href='editform.jsp?id=" + rs.getString("id") + "'>Edit</a></td>");
                        out.println("<td><a href='deleteuser.jsp?id=" + rs.getString("id") + "'>Delete</a></td>");
                        out.println("</tr>");
                        out.println("<c:forEach>");

                    }
                    st.close();

                %>

            </table>
            <a href="viewusers.jsp" class="btn btn-danger ml-3">Back to previous</a>
            <br><br><a href='logout.jsp' class="btn btn-danger ml-3">Log out</a>
        </form>
    </body>
</html>