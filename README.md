# xCompany - PHP Session Tracking Lab

## How to Run

1. Copy the `xCompany` folder into your XAMPP `htdocs` folder:
   - Windows: `C:\xampp\htdocs\xCompany`
   - Mac: `/Applications/XAMPP/htdocs/xCompany`

2. Start Apache from XAMPP Control Panel.

3. Open browser and go to:
   ```
   http://localhost/xCompany/index.php
   ```

## File Structure

```
xCompany/
├── index.php             (Public Home)
├── registration.php      (Register a new user)
├── login.php             (Login form with Remember Me)
├── forgot_password.php   (Recover password by email)
├── dashboard.php         (Logged-in user dashboard)
├── view_profile.php      (View user profile)
├── edit_profile.php      (Edit profile details)
├── change_picture.php    (Upload profile picture)
├── change_password.php   (Change password)
├── logout.php            (Logout)
├── style.css             (Basic styling)
└── uploads/              (Folder for profile pictures)
```

## How It Works

### Session Storage (instead of database)
- All registered users are stored in `$_SESSION['users']` as an array
- Key = username, Value = array of user details (name, email, password, gender, dob, picture)
- The currently logged-in user is stored in `$_SESSION['current_user']`

### Cookie Usage
- Cookie is used ONLY for the "Remember Me" feature on the login page
- When checked, the username is saved in a cookie for 7 days
- Next time the user visits login page, the username is auto-filled

## Testing Steps

1. Open `index.php` → see Public Home page
2. Click **Registration** → fill the form → Submit
3. Click **Login** → enter username & password (tick "Remember Me" if you want)
4. After login → you see the Dashboard
5. Try **View Profile**, **Edit Profile**, **Change Profile Picture**, **Change Password**
6. Click **Logout** → returns to public home
7. Use **Forgot Password** with a registered email to recover password

## Important Note

Since data is stored in SESSION (not database), all registered users will be **lost when the session expires** (or browser closed). This is by design as per the lab requirement.
