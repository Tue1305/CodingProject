<%@page import="com.mycompany.myjsp.UserDao"%>  
<jsp:useBean id="u" class="com.mycompany.myjsp.User"></jsp:useBean>  
<jsp:setProperty property="*" name="u"/>  
<%  
UserDao.delete(u);  
response.sendRedirect("viewusers.jsp");  
%>  