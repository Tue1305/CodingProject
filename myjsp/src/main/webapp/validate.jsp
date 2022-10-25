<%-- 
    Document   : validate
    Created on : 28 Feb, 2015, 8:50:26 AM
    Author     : Lahaul Seth
--%>
<%@page import="java.sql.ResultSet"%>
<%@page import="java.sql.PreparedStatement"%>
<%@page import="java.sql.DriverManager"%>
<%@page import="java.sql.Connection"%>
<%@page import="com.mycompany.myjsp.User"%>
<%@page import="javax.servlet.http.HttpSession"%>
<style>
    .error {
        padding-left: 20px;
        color: red;
        text-transform: uppercase;
    }
</style>
<%
    try {
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        Class.forName("com.mysql.jdbc.Driver");  // MySQL database connection
        Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/sample", "root", "1234");
        PreparedStatement pst = conn.prepareStatement("Select name,password from register where name=? and password=?");
        pst.setString(1, username);
        pst.setString(2, password);
        ResultSet rs = pst.executeQuery();
        if (rs.next()) {
            //  HttpSession session = request.getSession();
            session.setAttribute("username", username);
%>
<jsp:include page="index.jsp"></jsp:include>  
<%
//            out.println("Valid login credentials");
//            response.sendRedirect("index.jsp");
} else {
%>  
<jsp:include page="login.jsp"></jsp:include>  
<%
            out.println("<p class='error'>Invalid login credentials</p>");

        }
    } catch (Exception e) {
        out.println("Something went wrong !! Please try again");
    }
%>
