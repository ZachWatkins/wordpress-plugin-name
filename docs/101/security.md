# Security

1. Principle of least privilege
2. Verify client data on the server
3. Fail securely

## Principle of Least Privilege

An individual should have only the minimum access privileges necessary to perform a specific job or task and nothing more.

## Verify client data on the server

Information provided by an end user, such as a website visitor, is always under their control. In order to build a secure website or web application, you must verify any data that is sent from outside of the server to inside of the server. This should be done in a reasonable way that varies between different types of data.

## Fail Securely

Take care to write your code in such a way that if it fails during runtime it will not display confidential information to the browser or to another endpoint that allows an unauthorized person to obtain that confidential data.

## Sources

1. <https://cheatsheetseries.owasp.org/cheatsheets/Authorization_Cheat_Sheet.html>
2. <https://developer.mozilla.org/en-US/docs/Web/Security/Firefox_Security_Guidelines>
3. <https://cheatsheetseries.owasp.org/cheatsheets/Vulnerability_Disclosure_Cheat_Sheet.html>
