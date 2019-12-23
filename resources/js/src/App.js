import React from 'react';
import { AppBar, Toolbar, Typography } from '@material-ui/core';

const App = () => {
  return (
    <AppBar position="static">
      <Toolbar>
        <Typography variant="h6">
          Laravel React Docker Chat App
        </Typography>
      </Toolbar>
    </AppBar>
  );
};

export default App;
