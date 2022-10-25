import 'package:flutter/material.dart';
import 'package:flutter_application_1/list_view_page.dart';
import 'package:provider/provider.dart';
import 'globaldata.dart';
import 'get_data.dart';

// ignore: camel_case_types
class viewuser extends StatelessWidget {
  // ignore: use_key_in_widget_constructors
  const viewuser({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(globaldata.token),
      ),
      body: Center(
        child: ElevatedButton(
          onPressed: () {
            Navigator.push(
                context,
                MaterialPageRoute(
                    builder: (BuildContext context) => const listviewpage()));
          },
          child: const Text('Get all users'),
        ),
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () {
          ChangeNotifierProvider(
            create: (context) => getdata(),
            builder: (context, child) {
              return const listviewpage();
            },
          );
          Navigator.push(
              context,
              MaterialPageRoute(
                  builder: (BuildContext context) => const listviewpage()));
          // Add your onPressed code here!
        },
        backgroundColor: Colors.green,
        child: const Icon(Icons.navigation),
      ),
    );
  }
}
