import 'package:mason/mason.dart';

void run(HookContext context) {
  context.logger
      .warn('You need to add HasFirebaseTokens trait to app/Models/User model');
  context.logger.warn('You need to run this command:');
  context.logger.warn('composer require kutia-software-company/larafirebase');
}
