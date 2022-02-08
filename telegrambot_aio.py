import requests
from requests.structures import CaseInsensitiveDict
import time
import json
from datetime import datetime
import os


bot_token = ''

server = 'localhost/aio_update'
url_check_notif = 'http://'+server+'/api/get_notif_telegram'
url_update_data = 'http://'+server+'/api/update_log'
url_idchat = 'http://'+server+'/api/get_idchat_telegram'
url_token = 'http://'+server+'/api/get_token_telegram'


headers = CaseInsensitiveDict()
headers["Cache-Control"] = "no-cache, no-store, must-revalidate"
headers["Pragma"] = "no-cache"
headers["Expires"] = "0"

try:
    params = {'key': 'AIOsdLock2020'}
    getToken = requests.post(url_token, params, headers=headers)
    dataTokenJson = getToken.json()
    print(dataTokenJson['token'])
    bot_token = dataTokenJson['token']
except Exception as e:
    print(e)

api_url = 'https://api.telegram.org/bot' + bot_token + '/'


def send_text(chat_id, bot_message):
    method = 'sendMessage'
    params = {'chat_id': chat_id, 'text': bot_message, 'parse_mode': 'Markdown'}
    response = requests.post(api_url + method, params)
    return response.json()


def send_photo(chat_id, file_opened):
    method = 'sendPhoto'
    params = {'chat_id': chat_id}
    files = {'photo': file_opened}
    response = requests.post(api_url + method, params, files=files)
    return response.json()
    

while True:
    try:
        params = {'key': 'AIOsdLock2020'}
        data = requests.post(url_check_notif, params, headers=headers)
        dataJson = data.json()
        #print(dataJson)
        if int(dataJson['count']) > 0:
            #print(dataJson['data'])
            for dt in dataJson['data']:
                id_log = dt['id_log']
                cam = dt['cam']
                
                bot_message = dt['nama_karyawan']
                bot_message = bot_message + '\r\n'
                bot_message = bot_message + 'NIK ' + dt['nik']
                bot_message = bot_message + '\r\n'
                bot_message = bot_message + 'ROOM ' + dt['nama_room']
                bot_message = bot_message + '\r\n'
                bot_message = bot_message + 'Keterangan ' + dt['keterangan']
                bot_message = bot_message + '\r\n'
                bot_message = bot_message + 'Remarks ' + dt['remarks_log']
                bot_message = bot_message + '\r\n'
                bot_message = bot_message + 'Waktu akses ' + str(datetime.fromtimestamp(int(dt['access_time'])))
                bot_message = bot_message + '\r\n'
                print(bot_message)
                
                id_room = dt['id_room']
                params = {'key': 'AIOsdLock2020', 'id_room': id_room}
                dataIDchat = requests.post(url_idchat, params, headers=headers)
                dataIDchatJson = dataIDchat.json()
                if int(dataIDchatJson['count']) > 0:
                    #print(dataIDchatJson['data'])
                    for dtChat in dataIDchatJson['data']:
                        #print(dtChat)
                        idCHAT = dtChat['id_chat']

                        kirim_notif = send_text(idCHAT, bot_message)
                        print(kirim_notif)
                        print()
                        if cam != "":
                            if os.path.exists('component/dist/log_img/'+cam):
                                kirim_gambar = send_photo(idCHAT, open('component/dist/log_img/'+cam, 'rb'))
                                print(kirim_gambar)
                                print()
                            else:
                                print("img not found")

                params = {'key': 'AIOsdLock2020', 'idlog': id_log}
                update_log = requests.post(url_update_data, params, headers=headers)
                #print(update_log.text)
                        
    except Exception as e:
        print(e)

    time.sleep(2)


