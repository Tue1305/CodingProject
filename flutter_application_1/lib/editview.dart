import 'dart:convert';
import 'globaldata.dart';
import 'package:flutter/material.dart';
import 'package:flutter_linkify/flutter_linkify.dart';
// import 'package:localstorage/localstorage.dart';
import 'package:url_launcher/url_launcher_string.dart';
import 'package:http/http.dart' as http;
import 'package:pdf/pdf.dart';
import 'package:pdf/widgets.dart' as pw;
import 'package:printing/printing.dart';
import 'list_view_page.dart';

class PreviewScreen extends StatelessWidget {
  final pw.Document doc;

  const PreviewScreen({
    Key? key,
    required this.doc,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        leading: IconButton(
          onPressed: () => Navigator.pop(context),
          icon: const Icon(Icons.arrow_back_outlined),
        ),
        centerTitle: true,
        title: const Text("Preview"),
      ),
      body: PdfPreview(
        build: (format) => doc.save(),
        allowSharing: true,
        allowPrinting: true,
        initialPageFormat: PdfPageFormat.a4,
        pdfFileName: "mydoc.pdf",
      ),
    );
  }
}

// ignore: camel_case_types
class editview extends StatefulWidget {
  final int id;
  final String url, name, password, email;
  const editview(
      {Key? key,
      required this.id,
      required this.email,
      required this.name,
      required this.password,
      required this.url})
      : super(key: key);

  @override
  State<editview> createState() => _editviewState();

  void setuser(String name) {}
  void setemail(String email) {}
}

// ignore: camel_case_types
class _editviewState extends State<editview> {
  TextEditingController? _controller;
  TextEditingController? _emailcontroller;

  set setuser(String name) {}
  set setemail(String email) {}

  @override
  void initState() {
    super.initState();
    _controller = TextEditingController(text: widget.name);
    _controller?.addListener(() {
      final text = _controller == null ? "" : _controller!.text;
      widget.setuser(text);
    });

    _emailcontroller = TextEditingController(text: widget.email);
    _emailcontroller?.addListener(() {
      final text = _emailcontroller == null ? "" : _emailcontroller!.text;
      widget.setemail(text);
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Edit Page"),
      ),
      body: Center(
          child: Column(
        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
        children: [
          Container(
            height: 300.0,
            width: 300.0,
            color: Colors.white,
            child: Column(
              mainAxisAlignment: MainAxisAlignment.spaceEvenly,
              children: [
                // ignore: prefer_adjacent_string_concatenation
                Text("ID: " + "${widget.id}",
                    style: const TextStyle(color: Colors.black)),
                TextField(
                  controller: _controller,
                  // ignore: prefer_const_constructors
                  decoration: InputDecoration(
                    labelText: "Name: ",
                    labelStyle: const TextStyle(color: Colors.black),
                    border: const OutlineInputBorder(),
                    focusedBorder: OutlineInputBorder(
                      borderSide: Divider.createBorderSide(context),
                    ),
                  ),
                ),
                TextField(
                  controller: _emailcontroller,
                  // ignore: prefer_const_constructors
                  decoration: InputDecoration(
                    labelText: "Email: ",
                    labelStyle: const TextStyle(color: Colors.black),
                    border: const OutlineInputBorder(),
                    focusedBorder: OutlineInputBorder(
                      borderSide: Divider.createBorderSide(context),
                    ),
                  ),
                ),
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                  children: [
                    Text("Password: " + widget.password,
                        style: const TextStyle(color: Colors.black)),
                    // Text(
                    //   "Picture: " + Image.network(widget.url).toString(),
                    // )
                  ],
                ),
              ],
            ),
          ),
          Center(
            child: Linkify(
              onOpen: _onOpen,
              textScaleFactor: 2,
              text: "Photo Url: " + widget.url,
            ),
          ),
          Padding(
            padding: const EdgeInsets.all(8.0),
            child: ElevatedButton(
              child: const Text('Save'),
              onPressed: () {
                _save();
                Navigator.push(
                    context,
                    MaterialPageRoute(
                        builder: (BuildContext context) =>
                            const listviewpage()));
              },
            ),
          ),
          Padding(
            padding: const EdgeInsets.all(8.0),
            child: ElevatedButton(
              child: const Text('Create PDF'),
              onPressed: () {
                _createPdf();
              },
            ),
          ),
          Padding(
            padding: const EdgeInsets.all(8.0),
            child: ElevatedButton(
              child: const Text('View PDF'),
              onPressed: () {
                _displayPdf();
              },
            ),
          )
        ],
      )),
    );
  }

  // ignore: unused_element
  void _createPdf() async {
    final doc = pw.Document();
    final font = await PdfGoogleFonts.abelRegular();

    /// for using an image from assets
    // final image = await imageFromAssetBundle('assets/image.png');

    doc.addPage(
      pw.Page(
        pageFormat: PdfPageFormat.a4,
        build: (pw.Context context) {
          return pw.Column(
            children: [
              pw.SizedBox(
                child: pw.FittedBox(
                  child: pw.Text("${widget.id}",
                      style: pw.TextStyle(font: font, fontSize: 20)),
                ),
              ),
              pw.SizedBox(
                child: pw.FittedBox(
                  child:
                      // ignore: unnecessary_string_interpolations
                      pw.Text("${widget.name}",
                          style: const pw.TextStyle(fontSize: 20)),
                ),
              ),
              pw.SizedBox(
                child: pw.FittedBox(
                  child:
                      // ignore: unnecessary_string_interpolations
                      pw.Text("${widget.url}",
                          style: const pw.TextStyle(fontSize: 20)),
                ),
              ),
              pw.SizedBox(height: 20),
            ],
          );
        },
      ),
    ); // Page

    /// print the document using the iOS or Android print service:
    await Printing.layoutPdf(
        onLayout: (PdfPageFormat format) async => doc.save());

    /// share the document to other applications:
    // await Printing.sharePdf(bytes: await doc.save(), filename: 'my-document.pdf');

    /// tutorial for using path_provider: https://www.youtube.com/watch?v=fJtFDrjEvE8
    /// save PDF with Flutter library "path_provider":
    // final output = await getTemporaryDirectory();
    // final file = File('${output.path}/example.pdf');
    // await file.writeAsBytes(await doc.save());
  }

  Future<void> _displayPdf() async {
    final doc = pw.Document();
    final font = await PdfGoogleFonts.abelRegular();
    doc.addPage(
      pw.Page(
        pageFormat: PdfPageFormat.a4,
        build: (pw.Context context) {
          return pw.Column(
            children: [
              pw.SizedBox(
                child: pw.FittedBox(
                  child: pw.Text("User ID: ${widget.id}",
                      style: pw.TextStyle(font: font, fontSize: 20)),
                ),
              ),
              pw.SizedBox(
                child: pw.FittedBox(
                  child:
                      // ignore: unnecessary_string_interpolations
                      pw.Text("Username: ${widget.name}",
                          style: pw.TextStyle(font: font, fontSize: 20)),
                ),
              ),
              pw.SizedBox(
                child: pw.FittedBox(
                  child:
                      // ignore: unnecessary_string_interpolations
                      pw.Text("Email: ${widget.email}",
                          style: pw.TextStyle(font: font, fontSize: 20)),
                ),
              ),
              // pw.SizedBox(
              //   child: pw.FittedBox(
              //     child:
              //         // ignore: unnecessary_string_interpolations
              //         pw.SvgImage("Picture: ${widget.url}"),
              //   ),
              // ),
              pw.SizedBox(height: 20),
            ],
          );
        },
      ),
    );

    /// open Preview Screen
    Navigator.push(
        context,
        MaterialPageRoute(
          builder: (context) => PreviewScreen(doc: doc),
        ));
  }

  Future<void> _onOpen(LinkableElement link) async {
    if (await canLaunchUrlString(link.url)) {
      await launchUrlString(link.url);
    } else {
      throw 'Could not launch $link';
    }
  }

  _save() async {
    debugPrint(_controller!.text);
    debugPrint(_emailcontroller!.text);

    Map<String, String> headera = {
      "Content-Type": "application/json",
      "Accept": "application/json",
      "Authorization": "Bearer " + globaldata.token,
    };
    // ignore: unused_local_variable, unnecessary_string_interpolations
    var url =
        Uri.parse("http://restapi.adequateshop.com/api/users/${widget.id}");
    var body = <String, String>{
      "id": "${widget.id}",
      "name": _controller!.text,
      "email": _emailcontroller!.text,
      "location": "USA"
    };

    debugPrint(url.toString());
    debugPrint(jsonEncode(body).toString());
    http.Response response = await http.put(
      url,
      headers: headera,
      body: jsonEncode(body),
    );
    if (response.statusCode != 200) {
      debugPrint("${response.statusCode}: ${response.body}");
      // throw Exception(
      //     "Request to $url failed with status ${response.statusCode}: ${response.body}");
    }
  }
}
