Dim WshShell
Set WshShell = CreateObject("WScript.Shell")
Do While True
     WScript.Sleep 1000*60       'µÈ´ý60Ãë
     WshShell.Run "C:\Intel\cron.bat",0,True
Loop