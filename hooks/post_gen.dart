import 'package:mason/mason.dart';

void run(HookContext context) {
  context.logger
      .warn('You need to add HasFirebaseTokens trait to app/Models/User model');
  context.logger.warn('You need to run this command:');
  context.logger.warn('composer require kutia-software-company/larafirebase');
  context.logger.warn('don\'t forget to add FCM_KEY to your .env file');
}
