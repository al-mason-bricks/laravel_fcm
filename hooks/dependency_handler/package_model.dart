import 'package:mason/mason.dart';

class PackageModel {
  late String name;

  PackageModel({
    required this.name,
  });

  PackageModel.fromJson(Map<String, dynamic> json) {
    this.name = json["package"];
  }
}
