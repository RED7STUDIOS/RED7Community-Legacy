using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;

namespace RED7Community_Creator
{
    public partial class Utils : Form
    {
        public Utils()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            using (frmMain frmMain = new frmMain())
            {
                frmMain.ShowDialog();
            }
        }
    }
}
