namespace RED7Community_Creator
{
    partial class frmMain
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.gbGeneralSettings = new System.Windows.Forms.GroupBox();
            this.gs_statusGithubURL = new System.Windows.Forms.TextBox();
            this.label17 = new System.Windows.Forms.Label();
            this.gs_statusURL = new System.Windows.Forms.TextBox();
            this.label18 = new System.Windows.Forms.Label();
            this.gs_storageURL = new System.Windows.Forms.TextBox();
            this.label4 = new System.Windows.Forms.Label();
            this.gs_apiURL = new System.Windows.Forms.TextBox();
            this.label2 = new System.Windows.Forms.Label();
            this.gs_mainURL = new System.Windows.Forms.TextBox();
            this.label1 = new System.Windows.Forms.Label();
            this.gbDatabaseSettings = new System.Windows.Forms.GroupBox();
            this.ds_name = new System.Windows.Forms.TextBox();
            this.label5 = new System.Windows.Forms.Label();
            this.ds_password = new System.Windows.Forms.TextBox();
            this.label6 = new System.Windows.Forms.Label();
            this.ds_username = new System.Windows.Forms.TextBox();
            this.label7 = new System.Windows.Forms.Label();
            this.ds_server = new System.Windows.Forms.TextBox();
            this.label8 = new System.Windows.Forms.Label();
            this.gbSQLSettings = new System.Windows.Forms.GroupBox();
            this.ss_maintenanceMode = new System.Windows.Forms.TextBox();
            this.label15 = new System.Windows.Forms.Label();
            this.ss_appealEmail = new System.Windows.Forms.TextBox();
            this.label16 = new System.Windows.Forms.Label();
            this.ss_verifiedIcon = new System.Windows.Forms.TextBox();
            this.label13 = new System.Windows.Forms.Label();
            this.ss_premiumIcon = new System.Windows.Forms.TextBox();
            this.label9 = new System.Windows.Forms.Label();
            this.ss_currencyName = new System.Windows.Forms.TextBox();
            this.label10 = new System.Windows.Forms.Label();
            this.ss_registration = new System.Windows.Forms.TextBox();
            this.label11 = new System.Windows.Forms.Label();
            this.ss_siteName = new System.Windows.Forms.TextBox();
            this.label12 = new System.Windows.Forms.Label();
            this.gbMainUser = new System.Windows.Forms.GroupBox();
            this.mu_currency = new System.Windows.Forms.TextBox();
            this.label21 = new System.Windows.Forms.Label();
            this.mu_username = new System.Windows.Forms.TextBox();
            this.label24 = new System.Windows.Forms.Label();
            this.btnGenerate = new System.Windows.Forms.Button();
            this.gbGeneralSettings.SuspendLayout();
            this.gbDatabaseSettings.SuspendLayout();
            this.gbSQLSettings.SuspendLayout();
            this.gbMainUser.SuspendLayout();
            this.SuspendLayout();
            // 
            // gbGeneralSettings
            // 
            this.gbGeneralSettings.Controls.Add(this.gs_statusGithubURL);
            this.gbGeneralSettings.Controls.Add(this.label17);
            this.gbGeneralSettings.Controls.Add(this.gs_statusURL);
            this.gbGeneralSettings.Controls.Add(this.label18);
            this.gbGeneralSettings.Controls.Add(this.gs_storageURL);
            this.gbGeneralSettings.Controls.Add(this.label4);
            this.gbGeneralSettings.Controls.Add(this.gs_apiURL);
            this.gbGeneralSettings.Controls.Add(this.label2);
            this.gbGeneralSettings.Controls.Add(this.gs_mainURL);
            this.gbGeneralSettings.Controls.Add(this.label1);
            this.gbGeneralSettings.Font = new System.Drawing.Font("Segoe UI", 13F);
            this.gbGeneralSettings.Location = new System.Drawing.Point(697, 13);
            this.gbGeneralSettings.Name = "gbGeneralSettings";
            this.gbGeneralSettings.Size = new System.Drawing.Size(336, 313);
            this.gbGeneralSettings.TabIndex = 0;
            this.gbGeneralSettings.TabStop = false;
            this.gbGeneralSettings.Text = "General Settings (config.php)";
            // 
            // gs_statusGithubURL
            // 
            this.gs_statusGithubURL.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.gs_statusGithubURL.Location = new System.Drawing.Point(7, 273);
            this.gs_statusGithubURL.Name = "gs_statusGithubURL";
            this.gs_statusGithubURL.Size = new System.Drawing.Size(320, 29);
            this.gs_statusGithubURL.TabIndex = 12;
            this.gs_statusGithubURL.Text = "https://github.com/RED7STUDIOS/RED7Community-status";
            // 
            // label17
            // 
            this.label17.AutoSize = true;
            this.label17.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.label17.Location = new System.Drawing.Point(3, 249);
            this.label17.Name = "label17";
            this.label17.Size = new System.Drawing.Size(141, 21);
            this.label17.TabIndex = 11;
            this.label17.Text = "Status GitHub URL:";
            // 
            // gs_statusURL
            // 
            this.gs_statusURL.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.gs_statusURL.Location = new System.Drawing.Point(7, 217);
            this.gs_statusURL.Name = "gs_statusURL";
            this.gs_statusURL.Size = new System.Drawing.Size(320, 29);
            this.gs_statusURL.TabIndex = 10;
            this.gs_statusURL.Text = "https://status.red7community.ml";
            // 
            // label18
            // 
            this.label18.AutoSize = true;
            this.label18.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.label18.Location = new System.Drawing.Point(3, 193);
            this.label18.Name = "label18";
            this.label18.Size = new System.Drawing.Size(88, 21);
            this.label18.TabIndex = 9;
            this.label18.Text = "Status URL:";
            // 
            // gs_storageURL
            // 
            this.gs_storageURL.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.gs_storageURL.Location = new System.Drawing.Point(7, 161);
            this.gs_storageURL.Name = "gs_storageURL";
            this.gs_storageURL.Size = new System.Drawing.Size(320, 29);
            this.gs_storageURL.TabIndex = 8;
            this.gs_storageURL.Text = "https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.label4.Location = new System.Drawing.Point(3, 137);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(99, 21);
            this.label4.TabIndex = 7;
            this.label4.Text = "Storage URL:";
            // 
            // gs_apiURL
            // 
            this.gs_apiURL.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.gs_apiURL.Location = new System.Drawing.Point(7, 105);
            this.gs_apiURL.Name = "gs_apiURL";
            this.gs_apiURL.Size = new System.Drawing.Size(320, 29);
            this.gs_apiURL.TabIndex = 4;
            this.gs_apiURL.Text = "/API";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.label2.Location = new System.Drawing.Point(3, 81);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(69, 21);
            this.label2.TabIndex = 3;
            this.label2.Text = "API URL:";
            // 
            // gs_mainURL
            // 
            this.gs_mainURL.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.gs_mainURL.Location = new System.Drawing.Point(7, 49);
            this.gs_mainURL.Name = "gs_mainURL";
            this.gs_mainURL.Size = new System.Drawing.Size(320, 29);
            this.gs_mainURL.TabIndex = 2;
            this.gs_mainURL.Text = "http://red7community.ml";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.label1.Location = new System.Drawing.Point(3, 25);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(81, 21);
            this.label1.TabIndex = 1;
            this.label1.Text = "Main URL:";
            // 
            // gbDatabaseSettings
            // 
            this.gbDatabaseSettings.Controls.Add(this.ds_name);
            this.gbDatabaseSettings.Controls.Add(this.label5);
            this.gbDatabaseSettings.Controls.Add(this.ds_password);
            this.gbDatabaseSettings.Controls.Add(this.label6);
            this.gbDatabaseSettings.Controls.Add(this.ds_username);
            this.gbDatabaseSettings.Controls.Add(this.label7);
            this.gbDatabaseSettings.Controls.Add(this.ds_server);
            this.gbDatabaseSettings.Controls.Add(this.label8);
            this.gbDatabaseSettings.Font = new System.Drawing.Font("Segoe UI", 13F);
            this.gbDatabaseSettings.Location = new System.Drawing.Point(355, 13);
            this.gbDatabaseSettings.Name = "gbDatabaseSettings";
            this.gbDatabaseSettings.Size = new System.Drawing.Size(336, 261);
            this.gbDatabaseSettings.TabIndex = 9;
            this.gbDatabaseSettings.TabStop = false;
            this.gbDatabaseSettings.Text = "Database Settings (config.php)";
            // 
            // ds_name
            // 
            this.ds_name.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.ds_name.Location = new System.Drawing.Point(7, 217);
            this.ds_name.Name = "ds_name";
            this.ds_name.Size = new System.Drawing.Size(320, 29);
            this.ds_name.TabIndex = 8;
            this.ds_name.Text = "red7community";
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.label5.Location = new System.Drawing.Point(3, 193);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(55, 21);
            this.label5.TabIndex = 7;
            this.label5.Text = "Name:";
            // 
            // ds_password
            // 
            this.ds_password.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.ds_password.Location = new System.Drawing.Point(7, 161);
            this.ds_password.Name = "ds_password";
            this.ds_password.Size = new System.Drawing.Size(320, 29);
            this.ds_password.TabIndex = 6;
            this.ds_password.Text = "red7community_pass";
            // 
            // label6
            // 
            this.label6.AutoSize = true;
            this.label6.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.label6.Location = new System.Drawing.Point(3, 137);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(79, 21);
            this.label6.TabIndex = 5;
            this.label6.Text = "Password:";
            // 
            // ds_username
            // 
            this.ds_username.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.ds_username.Location = new System.Drawing.Point(7, 105);
            this.ds_username.Name = "ds_username";
            this.ds_username.Size = new System.Drawing.Size(320, 29);
            this.ds_username.TabIndex = 4;
            this.ds_username.Text = "red7community_user";
            // 
            // label7
            // 
            this.label7.AutoSize = true;
            this.label7.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.label7.Location = new System.Drawing.Point(3, 81);
            this.label7.Name = "label7";
            this.label7.Size = new System.Drawing.Size(84, 21);
            this.label7.TabIndex = 3;
            this.label7.Text = "Username:";
            // 
            // ds_server
            // 
            this.ds_server.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.ds_server.Location = new System.Drawing.Point(7, 49);
            this.ds_server.Name = "ds_server";
            this.ds_server.Size = new System.Drawing.Size(320, 29);
            this.ds_server.TabIndex = 2;
            this.ds_server.Text = "127.0.0.1";
            // 
            // label8
            // 
            this.label8.AutoSize = true;
            this.label8.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.label8.Location = new System.Drawing.Point(3, 25);
            this.label8.Name = "label8";
            this.label8.Size = new System.Drawing.Size(58, 21);
            this.label8.TabIndex = 1;
            this.label8.Text = "Server:";
            // 
            // gbSQLSettings
            // 
            this.gbSQLSettings.Controls.Add(this.ss_maintenanceMode);
            this.gbSQLSettings.Controls.Add(this.label15);
            this.gbSQLSettings.Controls.Add(this.ss_appealEmail);
            this.gbSQLSettings.Controls.Add(this.label16);
            this.gbSQLSettings.Controls.Add(this.ss_verifiedIcon);
            this.gbSQLSettings.Controls.Add(this.label13);
            this.gbSQLSettings.Controls.Add(this.ss_premiumIcon);
            this.gbSQLSettings.Controls.Add(this.label9);
            this.gbSQLSettings.Controls.Add(this.ss_currencyName);
            this.gbSQLSettings.Controls.Add(this.label10);
            this.gbSQLSettings.Controls.Add(this.ss_registration);
            this.gbSQLSettings.Controls.Add(this.label11);
            this.gbSQLSettings.Controls.Add(this.ss_siteName);
            this.gbSQLSettings.Controls.Add(this.label12);
            this.gbSQLSettings.Font = new System.Drawing.Font("Segoe UI", 13F);
            this.gbSQLSettings.Location = new System.Drawing.Point(12, 13);
            this.gbSQLSettings.Name = "gbSQLSettings";
            this.gbSQLSettings.Size = new System.Drawing.Size(336, 425);
            this.gbSQLSettings.TabIndex = 10;
            this.gbSQLSettings.TabStop = false;
            this.gbSQLSettings.Text = "SQL Settings:";
            // 
            // ss_maintenanceMode
            // 
            this.ss_maintenanceMode.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.ss_maintenanceMode.Location = new System.Drawing.Point(7, 385);
            this.ss_maintenanceMode.Name = "ss_maintenanceMode";
            this.ss_maintenanceMode.Size = new System.Drawing.Size(320, 29);
            this.ss_maintenanceMode.TabIndex = 14;
            this.ss_maintenanceMode.Text = "off";
            // 
            // label15
            // 
            this.label15.AutoSize = true;
            this.label15.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.label15.Location = new System.Drawing.Point(3, 361);
            this.label15.Name = "label15";
            this.label15.Size = new System.Drawing.Size(146, 21);
            this.label15.TabIndex = 13;
            this.label15.Text = "Maintenance Mode:";
            // 
            // ss_appealEmail
            // 
            this.ss_appealEmail.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.ss_appealEmail.Location = new System.Drawing.Point(7, 329);
            this.ss_appealEmail.Name = "ss_appealEmail";
            this.ss_appealEmail.Size = new System.Drawing.Size(320, 29);
            this.ss_appealEmail.TabIndex = 12;
            this.ss_appealEmail.Text = "appeals@redsevenstudios.com";
            // 
            // label16
            // 
            this.label16.AutoSize = true;
            this.label16.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.label16.Location = new System.Drawing.Point(3, 305);
            this.label16.Name = "label16";
            this.label16.Size = new System.Drawing.Size(103, 21);
            this.label16.TabIndex = 11;
            this.label16.Text = "Appeal Email:";
            // 
            // ss_verifiedIcon
            // 
            this.ss_verifiedIcon.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.ss_verifiedIcon.Location = new System.Drawing.Point(7, 273);
            this.ss_verifiedIcon.Name = "ss_verifiedIcon";
            this.ss_verifiedIcon.Size = new System.Drawing.Size(320, 29);
            this.ss_verifiedIcon.TabIndex = 10;
            this.ss_verifiedIcon.Text = "/assets/images/verified.png";
            // 
            // label13
            // 
            this.label13.AutoSize = true;
            this.label13.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.label13.Location = new System.Drawing.Point(3, 249);
            this.label13.Name = "label13";
            this.label13.Size = new System.Drawing.Size(99, 21);
            this.label13.TabIndex = 9;
            this.label13.Text = "Verified Icon:";
            // 
            // ss_premiumIcon
            // 
            this.ss_premiumIcon.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.ss_premiumIcon.Location = new System.Drawing.Point(7, 217);
            this.ss_premiumIcon.Name = "ss_premiumIcon";
            this.ss_premiumIcon.Size = new System.Drawing.Size(320, 29);
            this.ss_premiumIcon.TabIndex = 8;
            this.ss_premiumIcon.Text = "/assets/images/premium.png";
            // 
            // label9
            // 
            this.label9.AutoSize = true;
            this.label9.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.label9.Location = new System.Drawing.Point(3, 193);
            this.label9.Name = "label9";
            this.label9.Size = new System.Drawing.Size(110, 21);
            this.label9.TabIndex = 7;
            this.label9.Text = "Premium Icon:";
            // 
            // ss_currencyName
            // 
            this.ss_currencyName.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.ss_currencyName.Location = new System.Drawing.Point(7, 161);
            this.ss_currencyName.Name = "ss_currencyName";
            this.ss_currencyName.Size = new System.Drawing.Size(320, 29);
            this.ss_currencyName.TabIndex = 6;
            this.ss_currencyName.Text = "Bux";
            // 
            // label10
            // 
            this.label10.AutoSize = true;
            this.label10.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.label10.Location = new System.Drawing.Point(3, 137);
            this.label10.Name = "label10";
            this.label10.Size = new System.Drawing.Size(122, 21);
            this.label10.TabIndex = 5;
            this.label10.Text = "Currency Name:";
            // 
            // ss_registration
            // 
            this.ss_registration.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.ss_registration.Location = new System.Drawing.Point(7, 105);
            this.ss_registration.Name = "ss_registration";
            this.ss_registration.Size = new System.Drawing.Size(320, 29);
            this.ss_registration.TabIndex = 4;
            this.ss_registration.Text = "on";
            // 
            // label11
            // 
            this.label11.AutoSize = true;
            this.label11.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.label11.Location = new System.Drawing.Point(3, 81);
            this.label11.Name = "label11";
            this.label11.Size = new System.Drawing.Size(97, 21);
            this.label11.TabIndex = 3;
            this.label11.Text = "Registration:";
            // 
            // ss_siteName
            // 
            this.ss_siteName.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.ss_siteName.Location = new System.Drawing.Point(7, 49);
            this.ss_siteName.Name = "ss_siteName";
            this.ss_siteName.Size = new System.Drawing.Size(320, 29);
            this.ss_siteName.TabIndex = 2;
            this.ss_siteName.Text = "RED7Community";
            // 
            // label12
            // 
            this.label12.AutoSize = true;
            this.label12.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.label12.Location = new System.Drawing.Point(3, 27);
            this.label12.Name = "label12";
            this.label12.Size = new System.Drawing.Size(85, 21);
            this.label12.TabIndex = 1;
            this.label12.Text = "Site Name:";
            // 
            // gbMainUser
            // 
            this.gbMainUser.Controls.Add(this.mu_currency);
            this.gbMainUser.Controls.Add(this.label21);
            this.gbMainUser.Controls.Add(this.mu_username);
            this.gbMainUser.Controls.Add(this.label24);
            this.gbMainUser.Font = new System.Drawing.Font("Segoe UI", 13F);
            this.gbMainUser.Location = new System.Drawing.Point(355, 280);
            this.gbMainUser.Name = "gbMainUser";
            this.gbMainUser.Size = new System.Drawing.Size(336, 157);
            this.gbMainUser.TabIndex = 17;
            this.gbMainUser.TabStop = false;
            this.gbMainUser.Text = "Main User:";
            // 
            // mu_currency
            // 
            this.mu_currency.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.mu_currency.Location = new System.Drawing.Point(7, 105);
            this.mu_currency.Name = "mu_currency";
            this.mu_currency.Size = new System.Drawing.Size(320, 29);
            this.mu_currency.TabIndex = 8;
            this.mu_currency.Text = "999999999999";
            // 
            // label21
            // 
            this.label21.AutoSize = true;
            this.label21.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.label21.Location = new System.Drawing.Point(3, 81);
            this.label21.Name = "label21";
            this.label21.Size = new System.Drawing.Size(76, 21);
            this.label21.TabIndex = 7;
            this.label21.Text = "Currency:";
            // 
            // mu_username
            // 
            this.mu_username.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.mu_username.Location = new System.Drawing.Point(7, 49);
            this.mu_username.Name = "mu_username";
            this.mu_username.Size = new System.Drawing.Size(320, 29);
            this.mu_username.TabIndex = 2;
            this.mu_username.Text = "RED7Community";
            // 
            // label24
            // 
            this.label24.AutoSize = true;
            this.label24.Font = new System.Drawing.Font("Segoe UI", 12F);
            this.label24.Location = new System.Drawing.Point(3, 25);
            this.label24.Name = "label24";
            this.label24.Size = new System.Drawing.Size(84, 21);
            this.label24.TabIndex = 1;
            this.label24.Text = "Username:";
            // 
            // btnGenerate
            // 
            this.btnGenerate.Font = new System.Drawing.Font("Segoe UI", 20.25F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btnGenerate.ForeColor = System.Drawing.Color.FromArgb(((int)(((byte)(255)))), ((int)(((byte)(128)))), ((int)(((byte)(0)))));
            this.btnGenerate.Location = new System.Drawing.Point(697, 332);
            this.btnGenerate.Name = "btnGenerate";
            this.btnGenerate.Size = new System.Drawing.Size(336, 106);
            this.btnGenerate.TabIndex = 18;
            this.btnGenerate.Text = "GENERATE";
            this.btnGenerate.UseVisualStyleBackColor = true;
            this.btnGenerate.Click += new System.EventHandler(this.btnGenerate_Click);
            // 
            // frmMain
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(1044, 449);
            this.Controls.Add(this.btnGenerate);
            this.Controls.Add(this.gbMainUser);
            this.Controls.Add(this.gbSQLSettings);
            this.Controls.Add(this.gbDatabaseSettings);
            this.Controls.Add(this.gbGeneralSettings);
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "frmMain";
            this.ShowIcon = false;
            this.Text = "Generate";
            this.Load += new System.EventHandler(this.frmMain_Load);
            this.gbGeneralSettings.ResumeLayout(false);
            this.gbGeneralSettings.PerformLayout();
            this.gbDatabaseSettings.ResumeLayout(false);
            this.gbDatabaseSettings.PerformLayout();
            this.gbSQLSettings.ResumeLayout(false);
            this.gbSQLSettings.PerformLayout();
            this.gbMainUser.ResumeLayout(false);
            this.gbMainUser.PerformLayout();
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.GroupBox gbGeneralSettings;
        private System.Windows.Forms.TextBox gs_storageURL;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.TextBox gs_apiURL;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.TextBox gs_mainURL;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.GroupBox gbDatabaseSettings;
        private System.Windows.Forms.TextBox ds_name;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.TextBox ds_password;
        private System.Windows.Forms.Label label6;
        private System.Windows.Forms.TextBox ds_username;
        private System.Windows.Forms.Label label7;
        private System.Windows.Forms.TextBox ds_server;
        private System.Windows.Forms.Label label8;
        private System.Windows.Forms.GroupBox gbSQLSettings;
        private System.Windows.Forms.TextBox ss_maintenanceMode;
        private System.Windows.Forms.Label label15;
        private System.Windows.Forms.TextBox ss_appealEmail;
        private System.Windows.Forms.Label label16;
        private System.Windows.Forms.TextBox ss_verifiedIcon;
        private System.Windows.Forms.Label label13;
        private System.Windows.Forms.TextBox ss_premiumIcon;
        private System.Windows.Forms.Label label9;
        private System.Windows.Forms.TextBox ss_currencyName;
        private System.Windows.Forms.Label label10;
        private System.Windows.Forms.TextBox ss_registration;
        private System.Windows.Forms.Label label11;
        private System.Windows.Forms.TextBox ss_siteName;
        private System.Windows.Forms.Label label12;
        private System.Windows.Forms.GroupBox gbMainUser;
        private System.Windows.Forms.TextBox mu_currency;
        private System.Windows.Forms.Label label21;
        private System.Windows.Forms.TextBox mu_username;
        private System.Windows.Forms.Label label24;
        private System.Windows.Forms.Button btnGenerate;
        private System.Windows.Forms.TextBox gs_statusGithubURL;
        private System.Windows.Forms.Label label17;
        private System.Windows.Forms.TextBox gs_statusURL;
        private System.Windows.Forms.Label label18;
    }
}

