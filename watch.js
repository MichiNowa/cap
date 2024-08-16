const { spawn } = require('child_process');

// Helper function to run a command and log its output
function runCommand(command, args = [], options = {}) {
    return spawn(command, args, {
        stdio: 'inherit',
        shell: true,
        ...options
    });
}

// Main function to execute all commands
async function main() {

  runCommand('npx', ['postcss', './src/tailwind.css', '-o', './public/css/main.min.css', '--watch']);

  await new Promise((resolve) => setTimeout(resolve, 1000)); // Wait for second

  // Start the PHP server
  runCommand('php', ['-S', 'localhost:8000', 'index.php']);

  await new Promise((resolve) => setTimeout(resolve, 2000));
  runCommand('node', ['https.js']);
}

// Execute the main function
main();