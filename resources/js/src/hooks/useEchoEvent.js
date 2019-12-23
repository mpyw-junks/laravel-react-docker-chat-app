import { useEffect } from 'react';

const CHANNEL_PREFIX = process.env.MIX_REDIS_PREFIX;

export const usePublicEchoEvent = (callback, channel, event) => {
  useEchoEvent(callback, channel, event, 'channel');
};

export const usePrivateEchoEvent = (callback, channel, event) => {
  useEchoEvent(callback, channel, event, 'private');
};

const useEchoEvent = (callback, channel, event, method) => {
  channel = `${CHANNEL_PREFIX}${channel}`;

  useEffect(() => {
    const chan = window.Echo[method](channel);
    chan.on(event, (payload) => callback(payload));

    const listeners = chan.events[event];
    const listener = listeners[listeners.length - 1];

    return () => {
      for (let i = listeners.length - 1; i >= 0; --i) {
        if (listeners[i] === listener) {
          chan.socket.removeListener(event, listener);
          listeners.splice(i, 1);
        }
      }
      if (listeners.length === 0) {
        window.Echo.leave(channel);
      }
    };
  }, []);
};
