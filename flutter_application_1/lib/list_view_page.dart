// ignore_for_file: prefer_const_constructors

import 'package:flutter/material.dart';
import 'package:flutter_application_1/details_view.dart';
import 'package:provider/provider.dart';
import 'editview.dart';
import 'get_data.dart';
import 'globaldata.dart';
import 'package:http/http.dart' as http;

// ignore: camel_case_types
class listviewpage extends StatefulWidget {
  const listviewpage({Key? key}) : super(key: key);

  @override
  State<listviewpage> createState() => _listviewpageState();
}

// ignore: camel_case_types
class _listviewpageState extends State<listviewpage> {
  // ignore: unused_field
  // bool _isShown = true;
  @override
  void initState() {
    var fetchData = Provider.of<getdata>(context, listen: false);
    fetchData.getListData();
    super.initState();
  }

  void _delete(BuildContext context, ListData user) {
    showDialog(
        context: context,
        builder: (BuildContext ctx) {
          return AlertDialog(
            title: const Text('Please Confirm'),
            content: Column(
              children: [
                const Text('Are you sure to remove this user id:'),
                const SizedBox(height: 10),
                Align(
                    alignment: Alignment.centerLeft,
                    child: Text("ID: ${user.id}")),
                Align(
                    alignment: Alignment.centerLeft,
                    child: Text("Username: ${user.name}")),
                Align(
                    alignment: Alignment.centerLeft,
                    child: Text("Email: ${user.email}")),
              ],
            ),
            actions: [
              // The "Yes" button
              TextButton(
                  onPressed: () async {
                    Map<String, String> headera = {
                      "Content-Type": "application/json",
                      "Accept": "application/json",
                      "Authorization": "Bearer " + globaldata.token,
                    };
                    // ignore: unused_local_variable
                    var url = Uri.parse(
                        'http://restapi.adequateshop.com/api/users/${user.id}');
                    http.Response response =
                        await http.delete(url, headers: headera);

                    if (response.statusCode != 200) {
                      throw Exception(
                          "Request to $url failed with status ${response.statusCode}: ${response.body}");
                    }
                    debugPrint(response.body);

                    // Remove the box

                    setState(() {
                      Navigator.of(context).pushReplacement(
                          // ignore: unnecessary_new
                          new MaterialPageRoute(
                              builder: (BuildContext context) =>
                                  // ignore: unnecessary_new
                                  listviewpage()));
                    });
                  },
                  child: const Text('Yes')),
              TextButton(
                  onPressed: () {
                    // Close the dialog
                    Navigator.of(context).pop();
                  },
                  child: const Text('No'))
            ],
          );
        });
  }

  @override
  Widget build(BuildContext context) {
    context.read<getdata>().getListData();

    return Scaffold(
      appBar: AppBar(
        title: const Text("List View Page"),
      ),
      body: RefreshIndicator(
        onRefresh: _onRefresh,
        child: Center(
          child: Consumer<getdata>(builder: (context, value, child) {
            return value.data.isEmpty
                ? const CircularProgressIndicator()
                : ListView.builder(
                    itemCount: value.data.length,
                    itemBuilder: (context, i) {
                      return ListTile(
                        title: Text("${value.data[i].id}"),
                        subtitle: Text(value.data[i].name ?? ""),
                        trailing: Row(
                          mainAxisSize: MainAxisSize.min,
                          children: [
                            IconButton(
                                onPressed: () {
                                  Navigator.push(
                                      context,
                                      MaterialPageRoute(
                                          builder: (BuildContext context) =>
                                              editview(
                                                  id: (value.data[i].id),
                                                  url: (value.data[i]
                                                          .profilepicture ??
                                                      ""),
                                                  name: (value.data[i].name ??
                                                      ""),
                                                  email: (value.data[i].email ??
                                                      ""),
                                                  password:
                                                      (value.data[i].password ??
                                                          ""))));
                                },
                                icon: const Icon(Icons.edit)),
                            IconButton(
                                // This button is enabled only if _isShown = true
                                onPressed: () =>
                                    _delete(context, value.data[i]),
                                icon: const Icon(Icons.delete)),
                          ],
                        ),
                        onTap: () {
                          Navigator.push(
                              context,
                              MaterialPageRoute(
                                  builder: (context) => detailsview(
                                      id: ("${value.data[i].id}"),
                                      url: (value.data[i].profilepicture ?? ""),
                                      name: (value.data[i].name ?? ""),
                                      email: (value.data[i].email ?? ""),
                                      password:
                                          (value.data[i].password ?? ""))));
                        },
                      );
                    });
          }),
        ),
      ),
    );
  }

  Future<void> _onRefresh() async {
    await Future.delayed(const Duration(seconds: 2));
    await context.read<getdata>().getListData();

    setState(() {});
  }
}
