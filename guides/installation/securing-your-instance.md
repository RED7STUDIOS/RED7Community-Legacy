# Securing Your Instance

This page of the wiki is showing how to secure your instance of RED7Community.

### Removing access to the Super Admin (Owner) account

I suggest that you remove the password on the owner account to disable unauthorised access.

1. Login in to your database.
2. Go to the 'users' table.
3. Select the user with id 1.
4. Remove the password.

### Removing the "install" directory

{% hint style="danger" %}
This option is HIGHLY recommended and WOULD be required.
{% endhint %}

You SHOULD delete the "install" directory when you finish installing RED7Community.
