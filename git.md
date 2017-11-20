---
title: Git
---

====undo last commit====
[[http://stackoverflow.com/questions/927358/how-do-you-undo-the-last-commit|stackoverflow]]
  git reset HEAD~   
  

=====clone with dept 1=====
   git clone --depth 1 git@github.com:Globe4D/Globe4D.git

=====delete a file from git history =====
(for example when you already deleted it but github keeps complaining about LFS large files)
  git filter-branch --tree-filter 'rm bin/data/images/BalloonChair-Field.psd' HEAD

=====github software errors on windows=====
<code>
WARNING: git command could not be found. Please create an alias or add it to your PATH.
WARNING: Could not find ssh-agent
</code>

=====Github Compare - compare two branches=====
* https://github.com/USER/REPO/compare

=====Documentation=====
* https://www.gitbook.com/@companje/dashboard

=====Syncing a fork=====
https://help.github.com/articles/syncing-a-fork/
  git remote -v  #List the current configured remote repository for your fork.
  git fetch upstream

===== Splitting a subfolder out into a new repository=====
* https://help.github.com/articles/splitting-a-subfolder-out-into-a-new-repository/

==== Remove sensitive data ====
* https://help.github.com/articles/remove-sensitive-data/

=====fatal: unable to access 'C:\Users\User/.gitconfig': Permission denied=====
the HOME env variable might be wrong. Try 
<code>set HOME</code>
and fix it if needed by setting it to the right value or by removing it:
<code bash>set HOME=c:\Users\YOUR_USER_NAME
rem OR: set HOME=
</code>

=====flow for switching branches, removing untracked files, updating submodules=====
Warning: this will remove ALL untracked files and directories!!
<code>
git checkout master
git clean -xfdf     # be careful with this!
git checkout OtherBranchWithSubmodules
git submodule update --init --recursive
</code>


=====remove all untracked files and folders including everything in .gitignore=====
<code>git clean -xfdf</code>

=====create alias for clone recursive=====
in ~/.gitconfig
<code>
[alias]
        clr = clone --recursive
</code>

=====graphical interface for git=====
[[http://www.sourcetreeapp.com/download/|sourcetree]]

=====set remote url=====
<code>git remote set-url origin "git@github.com:USER/REPO.git"</code>

=====info about remote url=====
<code>git remote -v</code>

=====How to commit my current changes to a different branch in git=====
<code>
git stash
git checkout other-branch
git stash pop
</code>

=====code completion for git=====
<code bash>sudo port install git-core git-extras</code>

=====undo 'git add' before commit=====
<code>
git reset FILE
</code>

=====create a new branch=====
<code>
git checkout -b Demo
</code>

=====een branch pushen die remote nog niet bestaat=====
<code>
git push --all
</code>

=====move subdir to separate git repo=====
http://stackoverflow.com/questions/359424/detach-subdirectory-into-separate-git-repository

=====clone specific branch recursively=====
<code bash>
git clone --recursive -b BRANCHNAME git@github.com:..../.....git
</code>

=====compare two commits=====
<code>
git diff HEAD HEAD~
git diff HEAD HEAD~~
</code>

=====show all branches (local and remote)=====
<code bash>
git branch -a
</code>

=====show remote branches =====
<code bash>
git branch -r
</code>

=====clone a specific branch=====
<code bash>
git clone -b experimental git@github.com:companje/ofxArcText.git
</code>

=====existing repo=====
<code bash>
cd existing_git_repo
git remote add origin https://github.com/Doodle3D/Doodle3D.git
git push -u origin master
</code>

=====change url of remote origin=====
<code bash>git config remote.origin.url git@github.com:USER/PROJECT.git</code>

=====open git config in editor=====
<code bash>git config -e</code>

=====git remote update=====
a git remote update followed by a ''git diff'' shows the changes you will get for a ''git pull''

=====git pull=====
is a combination of ''git fetch'' and ''git merge''

=====force a push=====
<code bash>
git push -f origin RicksVersie
</code>

=====show branches with more information=====
<code bash>
git branch -av
</code>

=====show listing of commits=====
<code bash>
git reflog
</code>

=====move a branch=====
<code bash>
git branch -m master RicksVersie
git branch -m PetersVersie master
</code>

=====delete a local branch=====
<code bash>git branch -D crazy-idea</code>

=====rename a local branch=====
<code bash>git branch -M oldname newname</code>

=====git with colors=====
<code bash>
git config --global color.ui true
</code>

=====rollback /revert to last commit=====
not tested yet. [[http://stackoverflow.com/questions/4407232/git-rollback-to-a-previous-commit|more info]]
<code>
git reset --hard HEAD
</code>

=====merge a branch into another branch=====
<code bash>
git checkout experimental
git merge master
</code>

=====merge specific files/folder from another git branch=====
<code bash>
#You are in the branch you want to merge to
git checkout <branch_you_want_to_merge_from> <file_paths...>
</code>
[[http://jasonrudolph.com/blog/2009/02/25/git-tip-how-to-merge-specific-files-from-another-branch/|read more]]

=====git (on github) keeps asking for password when using pull or push=====
You might have cloned the project over https. Check if this is the case using
<code bash>
git config -l
</code>
now change the remote origin to:
<code bash>
git config remote.origin.url git@github.com:USER/PROJECT.git
</code>

=====verwijder de 'Leiden' branch op de remote=====
<code bash>
git push origin :Leiden
</code>

=====verwijder een folder uit de cache=====
(niet uit je directory structuur)
<code bash>
git rm -r --cached libs/
</code>

=====git push origin NAME=====
als je een nieuwe branch hebt gemaakt op een andere computer dan moet je die branch nog handmatig pushen naar remote met:
<code bash>
git push origin NAME
</code>

=====If you are just after tracking someone else's project, this get you started quickly=====
<code bash>
git clone url = svn checkout url
git pull = svn update
</code>

=====git clone depth=====
<code bash>
git clone git://github.com/openframeworks/openFrameworks.git –depth 1
</code>

=====GIT gui programs=====
By default a couple of GUI programs are installed with git, for browsing through history  and committing etc.
<code bash>
gitk
git gui
</code>
you might first need to run ''sudo apt-get  install gitk''

=====OSX git GUI's=====
* gitx
* http://brotherbard.com/blog/2010/03/experimental-gitx-fork/

=====open git config editor=====
<code bash>git config -e</code>
this opens the file .git/config
if this not works because of an error in .git/config just open the file with nano:
<code bash>nano .git/config</code>

=====In je repository kun je zo iets pushen naar de server (bijv. github)=====
<code bash>
cd addons_rick/
git add ofxArcBall/
git commit -am "added ofxArcBall"
git push origin master
</code>

=====checkout=====
to go back to a revision:
<code bash>
git checkout revisionid
</code>

to bring the repository back to it's most recent state
<code bash>
git checkout master
</code>

=====Set up git=====
<code bash>
  git config --global user.name "Your Name"
  git config --global user.email your@emailaddress.com
</code>

=====Get started with a newly created github repository=====
<code bash>
  mkdir PROJECTNAME
  cd PROJECTNAME
  git init
  touch README
  git add README
  git commit -m 'first commit'
  git remote add origin git@github.com:YOURUSERNAME/PROJECTNAME.git
  git push -u origin master
</code>

=====creating new remote git repository=====
<code bash>
git init
or
git --bare init
</code>

=====Permission denied (publickey)=====

You might be cloning a non-anonymous repository from github. If you just started using github (on your machine) github first needs to trust you. You can add the contents of ~/.ssh/id_rsa.pub to the SSH public key list on github at your account settings. If you don't want that just clone the repository through https or readonly.

Some very usefull info about ssh keys etc: http://help.github.com/ssh-issues/

=====Create id_rsa files with ssh-keygen=====
just run ''ssh-keygen''

=====Adding your public key to the server to remember your git user's password=====
<code bash>
scp ~/.ssh/id_rsa.pub user@remote.example.com:/tmp/id_rsa.pub
mkdir ~/.ssh
chmod 700 ~/.ssh
cat /tmp/id_rsa.pub >> ~/.ssh/authorized_keys
</code>

=====interesting article=====
A successful Git branching model » nvie.com
http://nvie.com/posts/a-successful-git-branching-model/

=====uitchecken van git project op onze server=====
hiervoor hebben we rick aan de 'git' groep toegevoegd met '''usermod -a -G git rick'''. Harmen deed ook nog iets met '''chgrp'''
<code bash>
git clone rick@git.giplt.nl:/home/giplt/git/datamining
</code>

=====Nieuw git project opzetten op onze server=====
<code bash>
ssh username@giplt.nl
cd git
mkdir newproject
cd newproject/
git --bare init
</code>

=====automatically pull from master=====
if you get this message:
<code bash>
If you often merge with the same branch, you may want to
configure the following variables in your configuration
file:

    branch.master.remote = <nickname>
    branch.master.merge = <remote-ref>
    remote.<nickname>.url = <url>
    remote.<nickname>.fetch = <refspec>
</code>

open the .git/config file (ie. by ''git config -e'') and set the branch.master.remote to ''origin'' and the branch.master.merge to ''refs/heads/master''

<code bash>
[core]
        repositoryformatversion = 0
        filemode = true
        bare = false
        logallrefupdates = true
        ignorecase = true

[remote "origin"]
        url = rick@companje.nl:/home/rick/git/Globe4D-base
        #fetch = +refs/heads/*:refs/remotes/origin/*
        fetch = refs/heads/master
</code>
=====Eenmalig git configureren voor multi user repositories op de server=====
(for the record, want is nu al gedaan)
Dit zorgt er voor dat bij een commit de gepushde files als group niet de userid krijgen van degene die een bestand heeft aangemaakt, maar de gedeelde group (bij ons 'git') waarbinnen iedereen schrijfrechten heeft.

<code bash>
sudo chmod -R g+ws *
sudo chgrp -R mygroup *

git repo-config core.sharedRepository true
</code>

=====remove origin from remote=====
<code bash>
git remote rm origin
</code>

=====git add=====
first do a ''git --bare init'' on the server
<code bash>
git remote add origin {url}
</code>

=====change editor for git=====
<code bash>
git config --global core.editor "nano"
</code>

=====in case of this error:=====
<code>
error: src refspec master does not match any.
error: failed to push some refs to ..
</code>
you're commit might went wrong or you just forgot to commit:
<code bash>
git commit -m 'first commit'
</code>

=====submodules in a project=====
see [[http://stackoverflow.com/questions/4161022/git-how-to-track-untracked-content/4162672#4162672|this page]]

add submodule to a project (this means to clone another repo into a subfolder of your repo)
<code bash>
git submodule add git://github.com/test/test.git subfolder/test
</code>

<code bash>
git submodule update --init
</code>

remove a submodule
<code bash>
git rm --cached folder/submodule
</code>

you can also clone your repo recursively, that way also submodules are cloned.

<code bash>
git clone --recursive http://server/repo.git
</code>

=====pull git submodules=====
see the [[http://book.git-scm.com/5_submodules.html|git book]]
<code bash>
git submodule init
git submodule update
</code>

nog niet getest:
<code bash>
git submodule update --init --recursive
</code>

=====remove traces of wrongly removed submodules=====
<code>git config -e</code>
<code>rm -rf .git/modules/*</code>

=====fatal: Needed a single revision =====
cloning probably resulted in an empty folder. Delete the folder and try to clone again.

=====useful git commands=====
http://xinyustudio.wordpress.com/2011/12/11/a-brief-list-of-git-commands/

=====git list files=====
<code bash>git ls-files</code>

=====git cheat sheet=====
http://help.github.com/git-cheat-sheets/