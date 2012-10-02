function openchildfixed(file,window) {
    childwindow=open(file,window,'resizable=no,scrollbars=yes,width=500,height=700');
    if (childwindow.opener == null) childwindow.opener = self;
    }

function openChild2(file,window) {
    childWindow=open(file,window,'resizable=yes,scrollbars=yes,width=700,height=711,statusbar=yes');
    if (childWindow.opener == null) childWindow.opener = self;
    }