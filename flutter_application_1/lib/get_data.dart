import 'dart:convert';
import 'package:flutter/foundation.dart';
import 'package:http/http.dart' as http;
import 'globaldata.dart';

// ignore: camel_case_types
class getdata with ChangeNotifier {
  List<ListData> data = [];

  Future getListData() async {
    Map<String, String> headera = {
      "Content-Type": "application/json",
      "Accept": "application/json",
      "Authorization": "Bearer " + globaldata.token,
    };
    debugPrint("Token: beforeget ${globaldata.token}");
    var url = Uri.parse('http://restapi.adequateshop.com/api/users?page=1');
    http.Response response = await http.get(url, headers: headera);
    if (response.statusCode != 200) {
      throw Exception(
          "Request to $url failed with status ${response.statusCode}: ${response.body}");
    }
    var jsonData = json.decode(response.body);

    for (var user in jsonData['data']) {
      ListData list = ListData(user["id"], user["name"], user["email"],
          user["password"], user["profilepicture"]);
      data.add(list);
    }

    notifyListeners();
    return data;
  }
}

class ListData {
  final int id;
  String? name, email, password, profilepicture;

  ListData(this.id, this.name, this.email, this.password, this.profilepicture);
}
