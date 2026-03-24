# ChatPHP

![PHP](https://img.shields.io/badge/PHP-Chat_System-777bb4?logo=php)
![Status](https://img.shields.io/badge/Status-Active-brightgreen)
![License](https://img.shields.io/badge/License-Not_Specified-lightgrey)

一個使用 **PHP** 打造的簡易聊天系統，包含註冊、登入、好友管理、聊天、聊天記錄等功能。
A simple chat system built with **PHP**, supporting user login, friend management, messaging and message history.

---

## 📘 Features | 功能特色

* 🧑‍💻 **註冊 / 登入系統**
* 👥 **好友管理（新增／移除）**
* 💬 **聊天系統**（類即時互動）
* 🕑 **聊天記錄顯示**
* 🎨 **基本前端介面與樣式**

---

## 🛠️ Technologies | 使用技術

* **PHP**
* **MySQL**（或其他 RDB，透過 db_connect / add / get / remove 操作）
* **HTML / CSS**
* （可選）JavaScript 用於提升互動性

---

## 📂 Project Structure | 專案結構

```
ChatPHP/
│── index.php
│── login.php
│── register.php
│── dashboard.php
│── chat.php
│── chatHistoryDisplay.php
│── db_connect.php
│── db_add.php
│── db_get.php
│── db_remove.php
│── style.css
│── README.md
```

---

## 🚀 Getting Started | 安裝與執行

### ✔ 前置需求

請先準備：

* Apache / Nginx（或任意支援 PHP 的 Web 伺服器）
* PHP 7+
* MySQL or MariaDB

### ✔ 安裝步驟

1. Clone 專案：

   ```bash
   git clone https://github.com/wamgbo/ChatPHP.git
   ```
2. 建立資料庫，例如：

   ```
   chatphp_db
   ```
3. 修改 `db_connect.php`：

   ```php
   $servername = "localhost";
   $username = "root";
   $password = "your_password";
   $dbname = "chatphp_db";
   ```
4. 建立資料表（使用者、好友、訊息）。如果需要，我可以幫你寫完整 SQL Schema。
5. 將專案放到 Web root，例如：

   ```
   /var/www/html/ChatPHP
   ```
6. 在瀏覽器輸入：

   ```
   http://localhost/ChatPHP
   ```

---

## 💡 Usage | 使用方式

1. 註冊帳號
2. 登入
3. 新增好友
4. 點選好友開啟聊天
5. 查看聊天記錄

---

## 🔧 Contributing | 貢獻指南

歡迎提交 Issue 或 Pull Request。
Fork → 建立分支 → 提交 PR。

---
