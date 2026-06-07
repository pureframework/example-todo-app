<?php
// GENERATED Sun, 07 Jun 2026 03:08:24 +0000

// account.sql
/**
 * Generated row class for table `account`.
 * @property int $id (primary key; auto-increment)
 * @property string $created (default CURRENT_TIMESTAMP)
 * @property string $updated (default CURRENT_TIMESTAMP)
 * @property string $account_uuid
 * @property string $username
 * @property string $password_hash
 */
class account {
  public static string $uuidProperty = 'account_uuid';

  /** @var list<string> Columns omitted on insert (auto-increment / DB defaults) */
  public static array $insertSkip = ['id', 'created', 'updated'];

  /** @var list<string> Columns omitted on update (identity / immutable) */
  public static array $updateSkip = ['id', 'created', 'account_uuid'];

  public int $id = 0;
  public string $created = '';
  public string $updated = '';
  public string $account_uuid = '';
  public string $username = '';
  public string $password_hash = '';
}

// todo.sql
/**
 * Generated row class for table `todo`.
 * @property int $id (primary key; auto-increment)
 * @property string $created (default CURRENT_TIMESTAMP)
 * @property string $updated (default CURRENT_TIMESTAMP)
 * @property string $todo_uuid
 * @property string $account_uuid
 * @property string $title
 * @property ?string $completed_at
 */
class todo {
  public static string $uuidProperty = 'todo_uuid';

  /** @var list<string> Columns omitted on insert (auto-increment / DB defaults) */
  public static array $insertSkip = ['id', 'created', 'updated'];

  /** @var list<string> Columns omitted on update (identity / immutable) */
  public static array $updateSkip = ['id', 'created', 'todo_uuid'];

  public int $id = 0;
  public string $created = '';
  public string $updated = '';
  public string $todo_uuid = '';
  public string $account_uuid = '';
  public string $title = '';
  public ?string $completed_at = null;
}

