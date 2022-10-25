import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_application_1/viewuser.dart';
import 'package:http/http.dart' as http;
import 'package:qr/qr.dart';
import 'dart:convert'; // for using json.decode()
import 'globaldata.dart';
import 'package:provider/provider.dart';
import 'get_data.dart';
import 'package:flutter_barcode_scanner/flutter_barcode_scanner.dart';
import 'package:barcode_widget/barcode_widget.dart';

void main() {
  runApp(MultiProvider(
      providers: [ChangeNotifierProvider(create: (_) => getdata())],
      child: const MyApp()));
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  static const String _title = 'Sample App';

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: _title,
      home: Scaffold(
        appBar: AppBar(title: const Text(_title)),
        body: const MyStatefulWidget(),
      ),
    );
  }
}

class MyStatefulWidget extends StatefulWidget {
  const MyStatefulWidget({Key? key}) : super(key: key);

  @override
  State<MyStatefulWidget> createState() => _MyStatefulWidgetState();
}

class _MyStatefulWidgetState extends State<MyStatefulWidget> {
  TextEditingController nameController = TextEditingController();
  TextEditingController passwordController = TextEditingController();
  String _scanBarcode = 'Unknown';
  final qrCode = QrCode(4, QrErrorCorrectLevel.L)
    ..addData('Hello, world in QR form!');
  get qrImage => QrImage(qrCode);

  Future<void> startBarcodeScanStream() async {
    FlutterBarcodeScanner.getBarcodeStreamReceiver(
            '#ff6666', 'Cancel', true, ScanMode.BARCODE)!
        // ignore: avoid_print
        .listen((barcode) => print(barcode));
  }

  Future<void> scanQR() async {
    String barcodeScanRes;
    // Platform messages may fail, so we use a try/catch PlatformException.
    try {
      barcodeScanRes = await FlutterBarcodeScanner.scanBarcode(
          '#ff6666', 'Cancel', true, ScanMode.QR);
      // ignore: avoid_print
      print(barcodeScanRes);
    } on PlatformException {
      barcodeScanRes = 'Failed to get platform version.';
    }

    // If the widget was removed from the tree while the asynchronous platform
    // message was in flight, we want to discard the reply rather than calling
    // setState to update our non-existent appearance.
    if (!mounted) return;

    setState(() {
      _scanBarcode = barcodeScanRes;
    });
  }

  Future<void> scanBarcodeNormal() async {
    String barcodeScanRes;
    // Platform messages may fail, so we use a try/catch PlatformException.
    try {
      barcodeScanRes = await FlutterBarcodeScanner.scanBarcode(
          '#ff6666', 'Cancel', true, ScanMode.BARCODE);
      // ignore: avoid_print
      print(barcodeScanRes);
    } on PlatformException {
      barcodeScanRes = 'Failed to get platform version.';
    }

    // If the widget was removed from the tree while the asynchronous platform
    // message was in flight, we want to discard the reply rather than calling
    // setState to update our non-existent appearance.
    if (!mounted) return;

    setState(() {
      _scanBarcode = barcodeScanRes;
    });
  }

  Future<http.Response> login() {
    return http.post(
      Uri.parse('http://restapi.adequateshop.com/api/authaccount/login'),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
      },
      body: jsonEncode(<String, String>{
        'email': nameController.text,
        'password': passwordController.text
      }),
    );
  }

  @override
  void initState() {
    super.initState();
    nameController = TextEditingController(text: 'tue@abc.com');
    passwordController = TextEditingController(text: '123456');
  }

  @override
  Widget build(BuildContext context) {
    return Padding(
        padding: const EdgeInsets.all(10),
        child: ListView(
          children: <Widget>[
            Container(
                alignment: Alignment.center,
                padding: const EdgeInsets.all(10),
                child: const Text(
                  'Welcome to Flutter CRUD example',
                  style: TextStyle(
                      color: Colors.blue,
                      fontWeight: FontWeight.w500,
                      fontSize: 30),
                )),
            Container(
                alignment: Alignment.center,
                padding: const EdgeInsets.all(10),
                child: const Text(
                  'Sign in',
                  style: TextStyle(fontSize: 20),
                )),
            Container(
              padding: const EdgeInsets.all(10),
              child: TextField(
                controller: nameController,
                decoration: const InputDecoration(
                  border: OutlineInputBorder(),
                  labelText: 'Email',
                ),
              ),
            ),
            Container(
              padding: const EdgeInsets.fromLTRB(10, 10, 10, 0),
              child: TextField(
                obscureText: true,
                controller: passwordController,
                decoration: const InputDecoration(
                  border: OutlineInputBorder(),
                  labelText: 'Password',
                ),
              ),
            ),
            TextButton(
              onPressed: () {
                //forgot password screen
              },
              child: const Text(
                'Forgot Password',
              ),
            ),
            Container(
                height: 50,
                padding: const EdgeInsets.fromLTRB(10, 0, 10, 0),
                child: ElevatedButton(
                  child: const Text('Login'),
                  onPressed: () async {
                    http.Response response = await login();
                    final body = json.decode(response.body);
                    debugPrint(response.body);

                    if (body['message'] == 'success') {
                      //Token is nested inside data field so it goes one deeper.
                      final String token = body['data']['Token'];
                      // debugPrint(token);
                      // ignore: unused_element
                      debugPrint("Token: $token");
                      globaldata.token = token;
                      globaldata.name = nameController.text;
                      globaldata.email = passwordController.text;
                      //debugPrint(info);
                      Navigator.push(
                          context,
                          MaterialPageRoute(
                              builder: (BuildContext context) =>
                                  const viewuser()));
                    } else {
                      ScaffoldMessenger.of(context).showSnackBar(
                        SnackBar(
                          content: const Text('Wrong email or password'),
                          action: SnackBarAction(
                            label: 'OK',
                            onPressed: () {
                              // Code to execute.
                            },
                          ),
                        ),
                      );
                    }
                  },
                )),
            Row(
              children: <Widget>[
                const Text('Does not have account?'),
                TextButton(
                  child: const Text(
                    'Sign in',
                    style: TextStyle(fontSize: 20),
                  ),
                  onPressed: () {
                    //signup screen
                  },
                )
              ],
              mainAxisAlignment: MainAxisAlignment.center,
            ),
            ElevatedButton(
                onPressed: () => scanBarcodeNormal(),
                child: const Text('Start barcode scan')),
            ElevatedButton(
                onPressed: () => scanQR(), child: const Text('Start QR scan')),
            ElevatedButton(
                onPressed: () => startBarcodeScanStream(),
                child: const Text('Start barcode scan stream')),
            Text('Scan result : $_scanBarcode\n',
                style: const TextStyle(fontSize: 20)),
            BarcodeWidget(
              barcode: Barcode.qrCode(), // Barcode type and settings
              data: 'Hello World', // Content
              width: 400,
              height: 160,
            ),
          ],
        ));
  }
}
