<?php

namespace App\Adapter;


/**
 * Class CaseMessage
 * @package App\Adapter
 * @author jaures kano <ruddyjaures@mail.com>
 */
class CaseMessage
{

    public const INVALID_KEY = 'Invalid api key';

    public const INVALID_TOKEN = 'Invalid user token';

    public const MAIL_INVALID = 'Mail that you provide is invalid';

    public const MAIL_EXIST = 'Mail already exist';

    public const CODE_ERROR = 'Password code d\'ont match';

    public const CODE_INVALID = 'Confirmation code d\'ont match';

    public const WRONG_PASSWORD = 'Wrong password';

    public const INSUFFICIENT = 'Insufficient card sold';

    public const MAIL_USED = 'Mail that you provide is already have an account';

    public const UNKNOW_EMAIL = 'Email is not registed';

    public const USER_NOT_EXIST = 'User not found';

    public const CARD_NOT_EXIST = 'Card not found';

    public const CARD_TYPE_NOT_EXIST = 'Card not found';

    public const UNKNOW_COUNTRY = 'The country that you provide is not supported';

    public const INVALID_ID = 'Id of entity is not correct, please verify type then send again';

}