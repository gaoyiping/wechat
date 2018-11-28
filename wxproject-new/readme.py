#! usr/bin/python
# -*- coding:utf-8 -*-
import os

current_path = os.getcwd()
def readme_add(path):
    f = file(path + "/README.md", 'w+')
    f.writelines("Naff's Project\n")
    f.writelines("======================\n")
    f.writelines("* Author: 高一平\n")
    f.writelines("* E-Mail: iam@gaoyiping.com\n")
    f.close()
    print path + "/README.md"

def fix_empty_dir(path):
    filelist = os.listdir(path)
    """
    if 'README.md' not in filelist:
        readme_add(path)
    """
    if 'Thumbs.db' in filelist:
        os.remove(path + "/Thumbs.db")
    if filelist:
        for fn in filelist:
            if os.path.isdir(path + "/" + fn):
                fix_empty_dir(path + "/" + fn)
    else:
        readme_add(path)
        
fix_empty_dir(current_path)