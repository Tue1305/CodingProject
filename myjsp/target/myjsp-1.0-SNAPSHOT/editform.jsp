<!DOCTYPE html>  
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core"%>
<%@page import="com.mycompany.myjsp.UserDao,com.mycompany.myjsp.User"%> 
<html>  
    <head>  
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">  
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <title>Edit Form</title>  
    </head>  
    <body>  
        <%
            String id = request.getParameter("id");
            User u = UserDao.getRecordById(Integer.parseInt(id));
        %>  

        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="mt-5">Edit Form</h1>  
                        <p>Please edit the input values and submit to update the record.</p>
                        <form action="edituser.jsp" method="post">  
                            <input class="form-group" type="hidden" name="id" value="<%=u.getId()%>"/>  
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="<%= u.getName()%>">
                                <span class="invalid-feedback"></span>
                            </div> 
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" value="<%= u.getPassword()%>">
                                <span class="invalid-feedback"></span>
                            </div> 
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" value="<%= u.getEmail()%>">
                                <span class="invalid-feedback"></span>
                            </div> 
                            <div class="form-group">
                                <label>Sex:</label>


                                <c:set var="gender" value="<%= u.getSex()%>"/>

                                Male <input type="radio" name="sex" 
                                            value="Male" <c:if test="${gender=='Male'}">checked</c:if>>
                                            Female <input type="radio" name="sex" 
                                                          value="Female" <c:if test="${gender=='Female'}">checked</c:if>>
                                </div>
                                <div>
                                    <label>Country:</label>  

                                <c:set var="ethnicity" value="<%= u.getCountry()%>"/>
                                <select name="country">  
                                    <option value="India" <c:if test="${ethnicity=='India'}">selected</c:if>>India</option>  
                                    <option value="Pakistan" <c:if test="${ethnicity=='Pakistan'}">seleced</c:if>>Pakistan</option>  
                                    <option value="Afghanistan" <c:if test="${ethnicity=='Afghanistan'}">selected</c:if>>Afghanistan</option>  
                                    <option value="Berma" <c:if test="${ethnicity=='Berma'}">selected</c:if>>Berma</option>  
                                    <option value="Other" <c:if test="${ethnicity=='Other'}">selected</c:if>>Other</option>  
                                </select>  
                            </div>
                            <input type="submit" class="btn btn-primary" value="Update User"/>
                            <a href="viewusers.jsp" class="btn btn-secondary ml-2">Cancel</a> 
                            </table>  
                        </form>
                                <br>
                        <div>
                            <form action = "upload.jsp?id=<%= u.getId() %>" method = "post"
                                  enctype = "multipart/form-data">
                                <input type = "file" name = "file" size = "50" />
                                <br />
                                <input type = "submit" value = "Upload File" />
                            </form>  
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>  
</html>  